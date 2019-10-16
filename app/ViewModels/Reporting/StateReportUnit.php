<?php

namespace App\ViewModels\Reporting;

use App\Models\State;
use test\Mockery\MagicParams;

class StateReportUnit
{
    /**
     * @var int the state id
     */
    private $id;

    /**
     * @var string the state name
     */
    private $name;

    /**
     * @var float the report unit value
     */
    private $value;

    public function __construct(int $stateId, string $stateName, float $value)
    {
        $this->id = $stateId;
        $this->name = $stateName;
        $this->value = $value;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getValue() : float {
        return $this->value;
    }

    public function toArray() : array {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'value' => $this->getValue(),
        ];
    }
}
