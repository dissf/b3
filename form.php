<?php $counting = ["0", "1", "2", "3"];?>
<?php $pnames = ["imm", "pass", "lev"];?>
<?php $powers = ["immortal", "passing through walls", "levitation"];?>
<head>
	<title>form</title>
	<link rel="stylesheet" href = "style.css">
</head>
<body class="content">
	<p><b>form</b></p>
    <form action="" method="POST">
      <p>name <input name="name"></p>
      <p>email <input name="email"></p>
      <p>year:
				<select name="year">
				    <?php for($i = 1900; $i < 2020; $i++) { ?>
				    <option value="<?php print $i; ?>"><?= $i; ?></option>
				    <?php } ?>
				  </select><br>
      </p>
      <p>gender:
      	<label><input type="radio" name = "gender" value = "m" checked>m</label>
      	<label><input type="radio" name = "gender" value = "f" >f</label>
      </p>
      <p>number of limbs:
          <?php for($k = 0; $k < 4; $k++){?>
         	<label><input type="radio" name = "hands" value = "<?php echo $k ?>"> <?php echo $counting[$k] ?> </label>
          <?php } ?>
      	<label><input type="radio" name = "hands" value = "4" checked>4</label>
      </p>
      <p>superpowers: <br>
      	<select size="3" multiple name = "abilities[]">
      		<?php for($i = 0; $i < 3; $i++) {?>
      		<option value = "<?php echo $pnames[$i] ?>"> <?php echo $powers[$i] ?></option>
      		<?php }?>
      	</select>
      </p>
      <p>biography:<br>
      	<textarea name = "bio" rows="4" cols="20" placeholder = text></textarea>
      </p>
      <p>agree
      	<input type = "checkbox" name = "contract">
      </p>
      <p><input type="submit" value="sumbit" /></p>
    </form>
</body>
