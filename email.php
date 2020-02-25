<?php
include "inc/header.php";
?>
   <head>
    <Title>Verifica l'email | ForumJuve</Title>
</head>
<style>
*{
    transition: all 0.6s;
    z-index: 99999999999999999999999999999999999999999999999999999;
}

html {
    height: auto;
}

body{
    font-family: 'Lato', sans-serif;
    color: #fff;
    background: #101010;
    margin: 0;
}

#main{
    display: table;
    width: 100%;
    height: 80%;
    text-align: center;
}

.fof{
	  display: table-cell;
	  vertical-align: middle;
}

.fof h1{
	  font-size: 50px;
	  display: inline-block;
	  padding-right: 12px;
	  animation: type .5s alternate infinite;
}
    span {
        color: white;
    }

@keyframes type{
	  from{box-shadow: inset -3px 0px 0px #888;}
	  to{box-shadow: inset -3px 0px 0px transparent;}
}
</style>
       <div id="main">
    	<div class="fof">
        		<h1>Controlla l'email</h1> <br>
        		<span>Ti abbiamo inviato un codice segreto al tuo indirizzo di posta.</span>
    	</div>
</div>