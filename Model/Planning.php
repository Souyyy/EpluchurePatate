<?php 
class Planning {
    private $id;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data) {
        foreach ($data as $key => $value) {
            $this->{'set' .ucwords($key)}($value);
        }
    }
    public final function setId($id) {
        $this->id=$id;
    }
    public final function getId(){
        return $this->id;
    }
}
