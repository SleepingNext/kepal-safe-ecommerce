<?php
function tableGenerator($tableConf, $dataTable, $pk, $url){
	echo "
			<div class='table-responsive'>
			<table class='table table-hover'>
			<thead>
				<tr>
					<th>No</th>";
					foreach($tableConf as $t){
						echo "<th>".$t['label']."</th>";
					}
	echo "
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>";
			$no = 1;
			if(count($dataTable) == 0){
				echo "<tr><td colspan=".(count($tableConf)+2).">Data Kosong</td></tr>";
			}else{
				foreach($dataTable as $r){
					echo "
						<tr>
							<td>".$no."</td>";
					foreach($tableConf as $t){
						echo "<td>".$r[$t['name']]."</td>";
					}
					echo 	"<td>
								<a href='".$url['hapus'].".php?".$pk."=".$r[$pk]."'>Hapus</a>
								<a href='".$url['edit'].".php?".$pk."=".$r[$pk]."'>Edit</a>
							</td></tr>";
					$no++;
				}
			}
	echo "
			</tbody>	
		</table></div>";
		}
function formGenerator($fields){
	$value = "";
	$disabled = "";
	$readonly = "";
	foreach($fields as $f){
		if(!isset($f['value'])) $value = null;
		else $value = $f['value'];
		
		if(isset($f['disabled'])) $disabled = 'disabled';
		else $disabled = null;
		if(isset($f['readonly'])) $disabled = 'readonly';
		else $readonly = null;
		
		if($f['name'] == 'input_group'){
			echo "<div class='row'>";
				foreach($f['list'] as $l){
					echo "<div class='col-sm-".$l['col']."'>";
						switch($l['type']){
							case "input" : 
								echo '
									<div class="form-group">
					                    <label for="'.$l['name'].'" '.$disabled.' '.$readonly.'>'.$l['label'].'</label>
					                    <input id="'.$l['name'].'" name="'.$l['name'].'" type="'.$l['inputType'].'" class="form-control" value="'.$value.'" '.$disabled.' '.$readonly.'>
									</div>
								';
								break;
							case "textarea": 
								echo '
									<div class="form-group">
					                    <label for="'.$l['name'].'" '.$disabled.' '.$readonly.'>'.$l['label'].'</label>
					                    <textarea id="'.$l['name'].'" name="'.$l['name'].'" class="form-control" value="'.$value.'" '.$disabled.' '.$readonly.'>'.$value.'</textarea>
									</div>
								';
								break;
							case "select" : 
								echo '
									<div class="form-group">
										<label for="'.$l['name'].'" '.$disabled.' '.$readonly.'>'.$l['label'].'</label>
										<select id="'.$l['name'].'" name="'.$l['name'].'" class="form-control" value="'.$value.'" '.$disabled.' '.$readonly.'>';
									foreach($l['options'] as $d){
										echo '<option value="'.$d[$l['optionValue']].'" '.$disabled.' '.$readonly.'>'.$d[$l['optionLabel']].'</option>';
									}	
								echo '</select>
									 </div>
								';
								break;
						}
					echo "</div>";
				}
			echo "</div>";
		}else{
			switch($f['type']){
				case "input" : 
					echo '
						<div class="form-group">
		                    <label for="'.$f['name'].'" '.$disabled.' '.$readonly.'>'.$f['label'].'</label>
		                    <input id="'.$f['name'].'" name="'.$f['name'].'" type="'.$f['inputType'].'" class="form-control" value="'.$value.'" '.$disabled.' '.$readonly.'>
						</div>
					';
					break;
				case "textarea": 
					echo '
						<div class="form-group">
		                    <label for="'.$f['name'].'" '.$disabled.' '.$readonly.'>'.$f['label'].'</label>
		                    <textarea id="'.$f['name'].'" name="'.$f['name'].'" class="form-control" value="'.$value.'" '.$disabled.' '.$readonly.'>'.$value.'</textarea>
						</div>
					';
					break;
				case "select" : 
					echo '
						<div class="form-group">
							<label for="'.$f['name'].'" '.$disabled.' '.$readonly.'>'.$f['label'].'</label>
							<select id="'.$f['name'].'" name="'.$f['name'].'" class="form-control" value="'.$value.'" '.$disabled.' '.$readonly.'>';
						foreach($f['options'] as $d){
							if($d[$f['optionValue']] == $f['value']){
								echo '<option value="'.$d[$f['optionValue']].'" '.$disabled.' '.$readonly.' selected>'.$d[$f['optionLabel']].'</option>';
							}else echo '<option value="'.$d[$f['optionValue']].'" '.$disabled.' '.$readonly.'>'.$d[$f['optionLabel']].'</option>';
						}	
					echo '</select>
						 </div>
					';
					break;
			}
		}
	}
}
function alert($pesan, $jenis = 'success'){
	return '<div role="alert" class="alert alert-'.$jenis.'">'.$pesan.'</div>';
}
?>
