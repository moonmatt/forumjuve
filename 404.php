<?php
include "inc/header.php";
?>
   <head>
    <Title>404 Pagina non trovata | ForumJuve</Title>
</head>
<style>
*{
    transition: all 0.6s;
}

html {
    height: auto;
}
    .preloader {
        background: red;
        display: none;
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
    color: #fff;
	  animation: type .5s alternate infinite;
}
    a {
        color: white;
    }
    a:hover {
        color: gray;
    }
@keyframes type{
	  from{box-shadow: inset -3px 0px 0px #333;}
	  to{box-shadow: inset -3px 0px 0px transparent;}
}
</style>
       <div id="main">
    	<div class="fof">
        		<h1>Pagina non trovata</h1> <br>
        		<a href="/">Home</a>
    	</div>
</div>