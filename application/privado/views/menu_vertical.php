<!DOCTYPE HTML>
<html>
<head>
    <title>Menu desplegable usando solo CSS</title>
    <link rel="stylesheet" href="estilos.css" />
</head>
<body>
    <style>
        * {
font-family:sans-serif;
list-style:none;
text-decoration:none;
margin:0;
padding:0;
}
 
.nav > li {
float:left;
}
 
.nav li a {
background:#0c9ba0;
color:#FFF;
display:block;
border:1px solid;
padding:10px 12px;
}
 
.nav li a:hover {
background:#0fbfc6;
}
.nav li ul {
display:none;
position:absolute;
min-width:140px;
}
.nav li:hover > ul {
display:block;
}
    </style>
<ul class="nav">
    <li><a href="">Home</a></li>
    <li><a href="">Servicios</a>
        <ul>
            <li><a href="">Diseno grafico</a></li>
            <li><a href="">Diseno web</a>
                <ul>
                    <li><a href="">Submenu 1</a></li>
                    <li><a href="">Submenu 2</a></li>
                    <li><a href="">Submenu 3</a></li>
                    <li><a href="">Submenu 4</a></li>
                    <li><a href="">Submenu 5</a></li>
                </ul>
            </li>
            <li><a href="">Marketing</a>
                <ul>
                    <li><a href="">Submenu 1</a></li>
                    <li><a href="">Submenu 2</a></li>
                    <li><a href="">Submenu 3</a>
                        <ul>
                            <li><a href="">Submenu 1</a></li>
                            <li><a href="">Submenu 2</a></li>
                            <li><a href="">Submenu 3</a></li>
                            <li><a href="">Submenu 4</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="">SEO</a></li>
        </ul>
    </li>
    <li><a href="">Acerca</a>
        <ul>
            <li><a href="">Historia</a></li>
            <li><a href="">Mision</a></li>
            <li><a href="">Vision</a></li>
        </ul>
    </li>
    <li><a href="">Contacto</a></li>
</ul>
</body>
</html>