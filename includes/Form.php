<?php
class Form{
    public $label;
    public $type;
    public $name;

    public function rowInput($label, $type, $name){
        echo 
        '
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="'.$this->type=$type.'" class="form-control" id="floatingInput"
                        placeholder="Enter Your First Name" name="'.$this->name=$name.'" required>
                    <label for="floatingInput">'.$this->label=$label.'</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput"
                        placeholder="Enter Your Last Name" name="postalCode">
                    <label for="floatingInput">Tax Number</label>
                </div>
            </div>
         </div>
        ';
    }
}