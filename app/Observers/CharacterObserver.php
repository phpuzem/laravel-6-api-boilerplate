<?php

namespace App\Observers;

/**
 * Class CharacterObserver
 * @package App\Observers
 */
class CharacterObserver
{
    /**
     * @param $model
     */
    public function created($model)
    {
        $job = $model->job;
        if (! $model->stat()->exists()) {
            $array = [
                'character_id' => $model->id,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
            switch ($job->id) {
                case 1 :
                    $array = array_merge($array, $this->calculateHordeWarriorJobStat());
                    break;
                case 2 :
                    $array = array_merge($array, $this->calculateHordeHunterJobStat());
                    break;
                case 3 :
                    $array = array_merge($array, $this->calculateHordeMagicianJobStat());
                    break;
                case 4 :
                    $array = array_merge($array, $this->calculateHordePriestJobStat());
                    break;
                case 5 :
                    $array = array_merge($array, $this->calculateAllyWarriorJobStat());
                    break;
                case 6 :
                    $array = array_merge($array, $this->calculateAllyHunterJobStat());
                    break;
                case 7 :
                    $array = array_merge($array, $this->calculateAllyMagicianJobStat());
                    break;
                case 8 :
                    $array = array_merge($array, $this->calculateAllyPriestJobStat());
                    break;
                default:
                    $array = array_merge($array, $this->calculateDefaultStat());

            }
            $model->stat()->insert($array);
        }
    }

    /**
     * @return array
     */
    private function calculateDefaultStat()
    {
        return [
            'health'           => 100,
            'mana'             => 100,
            'attack_power'     => 100,
            'defence'          => 100,
            'magic_power'      => 100,
            'intelligence'     => 100,
            'agility'          => 100,
            'resistance'       => 100,
            'level'            => 100,
            'level_percentage' => 100,
        ];
    }

    /**
     * @return array
     */
    private function calculateHordeWarriorJobStat()
    {
        return [
            'health'           => 100,
            'mana'             => 100,
            'attack_power'     => 150,
            'defence'          => 120,
            'magic_power'      => 100,
            'intelligence'     => 100,
            'agility'          => 100,
            'resistance'       => 100,
            'level'            => 100,
            'level_percentage' => 100,
        ];
    }

    /**
     * @return array
     */
    private function calculateHordeHunterJobStat()
    {
        return [
            'health'           => 100,
            'mana'             => 100,
            'attack_power'     => 170,
            'defence'          => 100,
            'magic_power'      => 100,
            'intelligence'     => 100,
            'agility'          => 100,
            'resistance'       => 100,
            'level'            => 100,
            'level_percentage' => 100,
        ];
    }

    /**
     * @return array
     */
    private function calculateHordeMagicianJobStat()
    {
        return [
            'health'           => 100,
            'mana'             => 100,
            'attack_power'     => 80,
            'defence'          => 100,
            'magic_power'      => 120,
            'intelligence'     => 100,
            'agility'          => 100,
            'resistance'       => 100,
            'level'            => 100,
            'level_percentage' => 100,
        ];
    }

    /**
     * @return array
     */
    private function calculateHordePriestJobStat()
    {
        return [
            'health'           => 100,
            'mana'             => 100,
            'attack_power'     => 60,
            'defence'          => 100,
            'magic_power'      => 100,
            'intelligence'     => 120,
            'agility'          => 100,
            'resistance'       => 100,
            'level'            => 100,
            'level_percentage' => 100,
        ];
    }

    /**
     * @return array
     */
    private function calculateAllyWarriorJobStat()
    {
        return [
            'health'           => 100,
            'mana'             => 100,
            'attack_power'     => 150,
            'defence'          => 120,
            'magic_power'      => 100,
            'intelligence'     => 100,
            'agility'          => 100,
            'resistance'       => 100,
            'level'            => 100,
            'level_percentage' => 100,
        ];
    }

    /**
     * @return array
     */
    private function calculateAllyHunterJobStat()
    {
        return [
            'health'           => 100,
            'mana'             => 100,
            'attack_power'     => 150,
            'defence'          => 100,
            'magic_power'      => 100,
            'intelligence'     => 100,
            'agility'          => 100,
            'resistance'       => 100,
            'level'            => 100,
            'level_percentage' => 100,
        ];
    }

    /**
     * @return array
     */
    private function calculateAllyMagicianJobStat()
    {
        return [
            'health'           => 100,
            'mana'             => 100,
            'attack_power'     => 150,
            'defence'          => 100,
            'magic_power'      => 100,
            'intelligence'     => 100,
            'agility'          => 100,
            'resistance'       => 100,
            'level'            => 100,
            'level_percentage' => 100,
        ];
    }

    /**
     * @return array
     */
    private function calculateAllyPriestJobStat()
    {
        return [
            'health'           => 100,
            'mana'             => 100,
            'attack_power'     => 150,
            'defence'          => 100,
            'magic_power'      => 100,
            'intelligence'     => 100,
            'agility'          => 100,
            'resistance'       => 100,
            'level'            => 100,
            'level_percentage' => 100,
        ];
    }
}
