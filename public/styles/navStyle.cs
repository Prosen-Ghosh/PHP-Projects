 nav ul {
    list-style-type: none;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
    background-color: #333;
}

nav li {
    float: left;
    border-right:10px solid #bbb;
}

nav li a {
    display: block;
    color: white;
    text-align: center;
    padding: 25px 35px;
    text-decoration: none;
}

nav li:last-child {
    border-right: none;
}

nav li a:hover {
    background-color: #111;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}

.position {
  margin-left: 150px;
  margin-top: -110px;
}

.header {
    padding: 0em;
    color: white;
    background-color: #f2f2f2;
    clear: left;
    text-align: center;
    width: 100%;
    height: 30%;
}
