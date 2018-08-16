<?php

?>
<script crossorigin src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
<?php

?>
<div class='list'>
<span class='item' >
<span class='element'><span id='collection' ></span></span>
<span class='element'><input name='collection' type='text' /></span>
</span>
<span class='item' >
<span class='element'><label>Entity</label></span>
<span class='element'><input name='entity' type='text' /></span>
</span>
<span class='item' >
<span class='element'><label>Attribute</label></span>
<span class='element'><input name='attribute' type='text' /></span>
</span>
<span class='item'>
<span class='element'><label>Variable</label></span>
<span class='element'><input name='variable' type='text' /></span>
</span>
<span class='item' >
<span class='element'><label>Value</label></span>
<span class='element'><input name='value' type='text' /></span>
</span>
<span class='item'>
<span class='element'><label>Save</label></span>
<span class='element'><input name='save' type='button' value='&#x2714;' /></span>
</span>
<span class='item'>
<span class='element'><label>Add</label></span>
<span class='element'><input name='add' type='button' value='&#x271A;' /></span>
</span>
<script>
const getMessage = () => "Hello World";
document.getElementById('collection').innerHTML = getMessage();
</script>
