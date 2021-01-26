# lager

```php
<?php

    function createSelectBox($optionCount){
        $out = '<select>';
        for($idx=1; $idx <= $optionCount; $idx++){
            $out .= '<option>' . $idx . '</option>';
        }
        $out .= '<option selected>0</option>';
        $out .= '</select>';
        return $out;
    }

?>
```
