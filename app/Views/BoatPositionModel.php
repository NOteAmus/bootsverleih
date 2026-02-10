<?php

namespace App\Models;

use CodeIgniter\Model;

class BoatPositionModel extends Model
{
    protected $table = 'boot_positions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
            'boot_id', 'reservation_id', 'x', 'y',
            'width', 'height', 'rotation', 'z_index',
            'slot_id', 'type', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
            'boot_id' => 'required|is_natural_no_zero',
            'x' => 'required|integer',
            'y' => 'required|integer',
            'width' => 'required|integer|greater_than[0]',
            'height' => 'required|integer|greater_than[0]',
            'type' => 'required|in_list[free,on_slot,in_water]'
    ];

    /**
     * Get all boat positions for marina view
     */
    public function getMarinaBoatPositions()
    {
        $builder = $this->db->table($this->table . ' bp');
        $builder->select('bp.*, i.name as boot_name, i.boat_color, i.boat_icon, i.boat_width, i.boat_height, 
                         i.slot_number, r.reservation_number, r.start_date, r.end_date');
        $builder->join('items i', 'i.id = bp.boot_id', 'left');
        $builder->join('reservations r', 'r.id = bp.reservation_id AND r.payment_status = "paid"', 'left');
        $builder->where('i.type', 'boot');
        $builder->orWhere('bp.type', 'free');
        $builder->orderBy('bp.z_index', 'ASC');

        return $builder->get()->getResultArray();
    }

    /**
     * Get boat positions by reservation
     */
    public function getByReservation($reservationId)
    {
        return $this->where('reservation_id', $reservationId)->findAll();
    }

    /**
     * Get boat positions on specific slot
     */
    public function getOnSlot($slotId)
    {
        return $this->where('slot_id', $slotId)
                ->where('type', 'on_slot')
                ->findAll();
    }

    /**
     * Save multiple boat positions
     */
    public function saveBoatPositions($positions)
    {
        $this->db->transStart();

        foreach ($positions as $position) {
            if (isset($position['id']) && $position['id']) {
                $this->update($position['id'], $position);
            } else {
                $this->insert($position);
            }
        }

        $this->db->transComplete();
        return $this->db->transStatus();
    }

    /**
     * Clear positions for a slot
     */
    public function clearSlot($slotId)
    {
        return $this->where('slot_id', $slotId)->delete();
    }

    /**
     * Move boat from water to slot
     */
    public function moveToSlot($boatPositionId, $slotId)
    {
        $slot = $this->db->table('items')
                ->select('slot_number, row, position')
                ->where('id', $slotId)
                ->where('type', 'liegeplatz')
                ->get()
                ->getRowArray();

        if (!$slot) {
            return false;
        }

        // Calculate position based on slot layout
        $x = $this->calculateSlotX($slot['row'], $slot['position']);
        $y = $this->calculateSlotY($slot['position']);

        return $this->update($boatPositionId, [
                'slot_id' => $slotId,
                'type' => 'on_slot',
                'x' => $x,
                'y' => $y,
                'rotation' => 0,
                'z_index' => 10 // Higher z-index when on slot
        ]);
    }

    /**
     * Move boat from slot to water
     */
    public function moveToWater($boatPositionId)
    {
        // Generate random position in water area
        $x = rand(100, 800);
        $y = rand(100, 500);

        return $this->update($boatPositionId, [
                'slot_id' => null,
                'type' => 'in_water',
                'x' => $x,
                'y' => $y,
                'z_index' => 5
        ]);
    }

    private function calculateSlotX($row, $position)
    {
        // Mapping rows to X positions
        $rowPositions = [
                'A' => 200,
                'B' => 350,
                'C' => 500,
                'D' => 650,
                'E' => 800
        ];

        $x = $rowPositions[$row] ?? 200;

        // Adjust for left/right side
        if ($position % 2 === 0) {
            $x -= 120; // Left side
        } else {
            $x += 20; // Right side
        }

        return $x;
    }

    private function calculateSlotY($position)
    {
        // Each position step is 60px
        return 100 + (($position - 1) * 60);
    }
}