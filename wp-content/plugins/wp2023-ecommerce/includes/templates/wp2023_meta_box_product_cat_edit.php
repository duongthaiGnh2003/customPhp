
<?php

 
$image=get_term_meta($tag->term_id,"image",true);// $tag la tham so truyen vao ben kia
 
?>
<tr class="form-field">
    <th scope="row">
        <label for="image">Ảnh custom</label>
    </th>
    <td>
        <input name="image" id="image" type="text" value="<?= $image?>" size="40">
    </td>
</tr>
