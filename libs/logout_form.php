<?php


function display_logout_form(){
global $arrLangIndex;
echo '<form id="foo" method="POST" ><div id="data" style="display:none;"><ul><li>';

echo '<li><div><h2>'.$arrLangIndex['Reason to logout'].'</h2></div></li>';
		
$sql = "SELECT id,name FROM `logout_form` ORDER BY id";
$datos = kangQuerySimple($sql);

while(  $row = mysql_fetch_array($datos)  ) {
$id = $row['id'];
$name = $row['name'];	
echo	'<li><a href="?logout=yes&reason='.$name.'" style="text-decoration:none; color: #FFFFFF;"><div class="logout_buttons" >'.$name.'</div></a></li>';			
}

echo '</li></ul></div></form>';
	
}




function display_sections($id){
global $arrLangModule;
		
$sql = "SELECT id_section,id_section_member FROM `user` WHERE id=".$id;

$datos = kangQueryArray($sql);
$id_section = $datos['id_section'];
$id_section_ArraySql = explode(",",$datos['id_section_member'] ); //array de las secciones habilitadas

echo '<form id="foo2" method="POST"><div id="data2" style="display:none;"><label >Seccion de Trabajo:</label><div>';
		
		
			  
				$sql = kangQuerySimple(" SELECT id,name   FROM `section`  ORDER BY id ASC");
					
				while ($datos = mysql_fetch_array($sql)) {
					$id = $datos['id'];
					$arrayDatos[$id]=$datos['name'];	
				}//end while
				
				
				foreach ($arrayDatos as $key=>$name) {
									
						$br="<br>";			
					if( in_array($key,$id_section_ArraySql) ){
					
					//if( $key%2 == 0){$br="";} else{$br="<br>";}
				
					echo $name.'<input type="checkbox" class="id_section_member" name="id_section_member[]" value="'.$key.'" CHECKED/>'.$br;
					}
					else{
					echo $name.'<input type="checkbox" class="id_section_member" name="id_section_member[]" value="'.$key.'" />'.$br;
					
					}
					
				}	
		
echo '</div>';

?>

		<label >Puesto Físico de trabajo:</label>
		<div>
			
			 <select  name="id_section" id="id_section" style="width:300px;"> 
		<?php
		
		
		$sql = "SELECT id,name   FROM `section`  ORDER BY id ASC";
		$datos = kangQuerySimple($sql);

		while(  $row = mysql_fetch_array($datos)  ) {
		$id = $row['id'];

			echo '<option value="'.$id.'"';
			if( $id == $id_section ){ echo "selected=\"selected\" ";} 
			echo '>'.$row['name'].'</option>';
		}

		?>
		</select>	
		
		</div> 

<?php

echo'<br><input type="button" id="save_section" name="save_section" value="Guardar"></div </form>';









}

?>
