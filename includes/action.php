<?php
/*
*
*	Skripta služo kao kontroler za CRUD dobija akiju koju treba CRUD da obavi sa podatcima kojima će baratati
*	i na osnovu akcije poziva funkcije koje se nalaze u CRUD-u
*
*/
	//učitavanje skripte sa podatcima za konektovanje sa bazom dodljujse se promeniljvoj koja se korisiti kao objekat
	$cfg = include('config.php');
	//ucitavanje skripte sa CRUD funkcionalnošću
	require ('crud.php');
	//instanciranje konekcije za bazom podataka
	$connection = mysqli_connect($cfg->db_host,$cfg->db_username,$cfg->db_password,$cfg->db_name);
	//instance CRUD klase
	$crud = new Crud;
	//provera da li je poziv validan i koju akciju treba preuzeti
	if(array_key_exists('table', $_POST)){
	//table koji se koristi u sql komandama
		$table = $_POST['table'];    
		$date = date("Y-m-d h:i:s");
/*
*	Kreiranje novog podatka
*/
		if($_POST['action']==='create'){
	//podatci novog podataka
			$naziv = $_POST['naziv'];
			$cena = $_POST['cena'];
	//polja koja će ese koristiti u sql komandi
			$fields = "naziv,cena";
			$data ="'$naziv','$cena'";
	//result dobija nazad reultat pozivanja CRUD-a sa gore navadenim podatcima
			$result = $crud->create($connection, $fields, $table, $data);
			if(!$result){
				echo $result;
			}else {
			   echo "<p class='alert alert-success'>uspesno dodat prozivod</p>";
			}
/*
*	Iščitavanje poataka svih podatak iz baze
*/
		}else if($_POST['action']==='read'){
			$fields = "*";
	//pozivanje CRUD-a koji treba da vrati sve podatke iz baze
			$rez = $crud->get($connection,$fields,$table);
	//prevedi rezulate u JSON i vrati JS skripti
			$jason = json_encode($rez);
			echo $jason;
/*
*	Brisanje podataka
*/
		}elseif($_POST["action"]==="delete"){
	//deklarisanje promenljivih i dodeljivanje vrednosti podatcima iz AJAX poziva
			$id = $_POST['id'];
			$fields = "*";
	//uslpov koji se koristi u sql komandi tj. (WHERE id=numValue)
			$condition = "id='".$id."'";
	//poziavanje CRUD funkcije sa podatcima iz aAJAX poziva
			$result = $crud->delete($connection,$fields,$table,$condition);
	//prikaz reultata akcije ona osnovu toga da li je uspela ili ne
			if(!$result){
				echo $result;
			}else {
			   echo "<p class='alert alert-success'>uspesno obrisan prozivod</p>";
			}
	//ovde je trablo da ide iščitavanje jednog ili više elementa tu sam stao sa ovim projektom
		}elseif($_POST["action"]==="get"){
			
		}
	}