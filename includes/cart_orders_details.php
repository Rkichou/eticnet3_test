<?php
	
	session_start();
	require_once("../config.inc.php");
    require_once("./is_session_active.php");
    
	$options = $adresses = array(); // Initialiser un tableau pour stocker les options
    $sessionPrefix = $_SESSION['prefix_contractor'];
    //chercher tous les printshops
    $sql5="select * from printshop order by name";
    $retour5=mysqli_query($con,$sql5);
    //chercher toutes les unites de facturation
    $sqlUnite="select * from unite_facturation order by id";
    $retourUnite=mysqli_query($con,$sqlUnite);
    //chercher toutes les devises
    $sqlDevises="select * from devises order by id";
    $retourDevises=mysqli_query($con,$sqlDevises);
    $id_user=$_SESSION['id'];

    echo "<div class='actionsCart'>";
        echo "<button type='button' class='backButton' id='backButton' onclick=\"contractor_cart()\"> <img src='/images/return.png' alt='Back to store'> Back to store</button>";
		echo "<button type='button' class='orderButton' id='orderButton' onclick='save_orders($id_user)'>Place order</button>";
	echo "</div>";
	//$id=$_POST['id'];
    // Rècupère les suppliers en fonction du contractor
		

    echo "<div class='store'>";
        echo "<form id='order-form' class='order-form' method='POST' action=''>";
				
		echo "<div class='cart-body'>";
        $sqlG="select * from cart where id_user = '".$id_user."' and status = 0 group by reference_article";
        $retourG=mysqli_query($con,$sqlG);
        while($rowG=mysqli_fetch_array($retourG))
        {
            
            $reference=$rowG['reference_article'];
            echo "<div class='actionsCart'>";
                echo "<div class='title'>";
                    echo "<h2 class='h2'>".$rowG['reference_article']."</h2>";
                echo "</div>";
                echo "<button type='button' class='orderDelete' id='orderDelete' onclick=\"delete_order('". $reference."' , '".$id_user."');\"><img src='/images/trash.png' alt='Delete'></button>";
            echo "</div>";
            $sql="select * from cart where id_user = '".$id_user."' and status = 0 and reference_article = '".$reference."'";
            $retour=mysqli_query($con,$sql);
            while($row=mysqli_fetch_array($retour))
            {
                $quantite=$row['qty'];
                
                $id=$row['id'];
                $code_supplier=$row['code_supplier'];
                    
                    echo "<div class='form-groups'>";
                        echo "<div class='cart-group'>";
                        // Manufacturer
                            $sqlS="select * from  users_adresses  where `contractor`='" . $_SESSION['prefix_contractor_id'] . "'";
                            $retourS=mysqli_query($con,$sqlS);
                            while($rowS=mysqli_fetch_array($retourS))
                            {	
                                $option = "<option value=\"" . $rowS['code_supplier'] . "\">" . $rowS['company_name'] . "</option>";
                                if ($rowS['code_supplier'] == $code_supplier) {
                                    array_unshift($options, $option); // Insérer l'option au début du tableau si c'est le supplier                              
                                } 
                                else {
                                    $options[] = $option; // Ajouter l'option à la fin du tableau pour les autres suppliers
                                }                                   
                            }
                            echo "<select id=\"suppliers\" name=\"suppliers\" title=\"suppliers\" class=\"suppliers\">";
            
                                foreach ($options as $option) {
                                    echo $option;
                                }
                                echo "</select>";
                        echo "</div>";
                        echo "<div class='cart-group'>";	
                            echo "<select id='adresses' name='adresses' title='adresses' class='suppliers'>	";		
                        
                            // Manufacturer
                            $sqlSupp="select * from  users_adresses  where `code_supplier`='" . $code_supplier . "' ";
                            $retourSupp=mysqli_query($con,$sqlSupp);
                            echo $sqlSupp;
                            while($rowSupp=mysqli_fetch_array($retourSupp))
                            {	
                                
                                $adress = "<option value=\"adresse_1\">" . $rowSupp['adresse_1'] . "</option>";
                                if($rowS['adresse_2']){
                                    $adress = "<option value=\"adresse_2\">" . $rowSupp['adresse_2'] . "</option>";
                                }
                                if($rowS['adresse_3']){
                                    $adress = "<option value=\"adresse_3\">" . $rowSupp['adresse_3'] . "</option>";
                                }
                                
                                $adresses[] = $adress;
                                
                            }
                            foreach ($adresses as $adress) {
                                echo $adress;
                            } 
                            
                            echo "</select> ";
                                                
                        echo "</div>";
                        echo "<div class='cart-group'>";                           
                            echo "<input type='text' class='form-control' id='qty' name='qty' value='".$quantite."'>";
                        echo "</div>";
                        
                        
                        echo "<div class='cart-group'>";                           
                            echo "<button type='button' class='btn-cancel btn-primary' onclick='delete_cart_order($id);'><img src='/images/x.png' alt='Delete'></button>";
                        echo "</div>";
                    echo "</div>";
                    
			    
            }
        }
        echo "</div>";
        echo "<div class='cart-footer'>";
            /*echo "<div class='shipment'>";
                echo "<div class='title'>";
                    echo "<h3 class='h3'>Shipment method</h3>";
                echo "</div>";
                echo "<div class='cart-groups'>"; 
                    echo "<div class='cart-group'>";                            
                        echo "<input type='checkbox' class='form-control' id='etic' name='etic' value='byeticeurope'>By Etic Europe’s forwarder";
                    echo "</div>";
                    echo "<div class='cart-group'>";                            
                        echo "<input type='checkbox' class='form-control' id='self' name='self' value='byyourself'>Pickup by yourself*";
                    echo "</div>";
                    echo "<div id='error-message' class='error-message'></div>";
                    echo "<div class='cart-group'>";                            
                        echo "<p>*The packing list will be provided once the production is completed</p>";
                    echo "</div>";
                echo "</div>";                    
            echo "</div>"; 
            echo "<div class='billing'>";
                echo "<div class='title'>";
                    echo "<h3 class='h3'>Billing method</h3>";
                echo "</div>";
                echo "<div class='cart-groups'>"; 
                    echo "<div class='cart-group'>";                      
                        echo "<input type='text' class='form-control' id='company' name='company' placeholder='Company name'>";
                    echo "</div>";
                    echo "<div class='cart-group'>";                      
                        echo "<input type='text' class='form-control' id='address' name='address' placeholder='Address 1'>";
                    echo "</div>";
                    echo "<div class='cart-group'>";                      
                        echo "<input type='text' class='form-control' id='additionaladdress' name='additionaladdress' placeholder='Additional address'>";
                    echo "</div>";
                    echo "<div class='cart-group'>";                      
                        echo "<input type='text' class='form-control' id='zipcode' name='zipcode' placeholder='ZIP code'>";
                        echo "<input type='text' class='form-control' id='city' name='city' placeholder='City '>";
                        echo "<input type='text' class='form-control' id='country' name='country' placeholder='Country'>";
                    echo "</div>";
                echo "</div>";                  
            echo "</div>";  */        
        
        echo "</div>";
        echo "</form>";
        
    echo "</div>";
?>