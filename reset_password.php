
<?php 
$mail="";
if (isset($_POST['email'])){

$mail = $_POST['email'];
}

?>
    <div class="main_reset_password">
        <h1>Password reset e-mail sent</h1><br>
        <p>An e-mail has been sent to your address <?= $mail ?></p> 
		<p>Follow the instructions provided to reset your password. </p>
        <!-- <p>Follow the instructions provided to reset your password.</p> -->
        <button class="Conex-btn" onclick="window.location.href='login.php'">Connexion page</button>
    </div>
    
