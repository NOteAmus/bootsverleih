<?php

namespace App\Models;

use CodeIgniter\Model;

class BoatPositionModel extends Model
{
    protected $table = 'boat_positions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'ship_id',
        'ship_name',
        'slot_number',
        'grid_x',
        'grid_y',
        'grid_width',
        'grid_height'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Get all boat positions for marina view
     */
    public function getMarinaBoatPositions()
    {
        return $this->findAll();
    }

    /**
     * Update multiple boat positions (batch update)
     */
    public function updateBoatPositions(array $positions)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        try {
            $db->transStart();

            foreach ($positions as $position) {
                if (!isset($position['id'])) {
                    continue;
                }

                $updateData = [
                    'grid_x' => $position['x'] ?? 0,
                    'grid_y' => $position['y'] ?? 0,
                ];

                if (isset($position['newSlot'])) {
                    $updateData['slot_number'] = $position['newSlot'];
                }

                $builder->where('id', $position['id'])->update($updateData);
            }

            $db->transComplete();

            return $db->transStatus();
        } catch (\Exception $e) {
            log_message('error', 'Update boat positions failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Initialize default boat positions if table is empty
     */
    public function initializeDefaultPositions()
    {
        // Check if table is empty
        if ($this->countAll() > 0) {
            return false;
        }

        $defaultPositions = [
            ['ship_id' => 1, 'ship_name' => 'Bavaria 37', 'slot_number' => 'A2', 'grid_x' => 0, 'grid_y' => 0, 'grid_width' => 2, 'grid_height' => 2],
            ['ship_id' => 2, 'ship_name' => 'Hanse 388', 'slot_number' => 'B3', 'grid_x' => 3, 'grid_y' => 0, 'grid_width' => 2, 'grid_height' => 2],
            ['ship_id' => 3, 'ship_name' => 'Jeanneau 349', 'slot_number' => 'C4', 'grid_x' => 0, 'grid_y' => 3, 'grid_width' => 2, 'grid_height' => 2],
            ['ship_id' => 4, 'ship_name' => 'Quicksilver 675', 'slot_number' => 'D2', 'grid_x' => 3, 'grid_y' => 3, 'grid_width' => 2, 'grid_height' => 2],
            ['ship_id' => 5, 'ship_name' => 'Bayliner VR6', 'slot_number' => 'E1', 'grid_x' => 6, 'grid_y' => 0, 'grid_width' => 2, 'grid_height' => 2],
            ['ship_id' => 6, 'ship_name' => 'Zodiac 310', 'slot_number' => 'A5', 'grid_x' => 6, 'grid_y' => 3, 'grid_width' => 2, 'grid_height' => 2],
        ];

        return $this->insertBatch($defaultPositions);
    }

    /**
     * Move boat to specific slot
     */
    public function moveToSlot($boatPositionId, $slotId)
    {
        // Here you would get the slot coordinates and update the position
        // For now, this is a placeholder
        return $this->update($boatPositionId, [
            'slot_number' => $slotId
        ]);
    }

    /**
     * Move boat to water (remove from slot)
     */
    public function moveToWater($boatPositionId)
    {
        return $this->update($boatPositionId, [
            'slot_number' => null
        ]);
    }

    /**
     * Save boat positions (alias for updateBoatPositions)
     */
    public function saveBoatPositions(array $positions)
    {
        return $this->updateBoatPositions($positions);
    }
}
