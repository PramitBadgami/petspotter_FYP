

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-o3udR5PwD9hJ2zUj5nIBz5wzfuqCfamgJ3uBO3F+h4BBtlK/7vF78qA3bBRbiZ2v3" crossorigin="anonymous"></script>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
  <!-- JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.15.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
     <link rel="stylesheet" href="australia.css">
    <title>Study In Australia</title>

</head>
<body>

<style>
@font-face {
    font-family: 'MyCustomFont';
    src: url('path-to-your-font.woff2') format('woff2'),
         url('path-to-your-font.woff') format('woff');
    /* You can specify multiple font file formats for cross-browser compatibility */
}

body{
    margin: 0;
    padding:  0;
    font-family: Verdana, sans-serif;
    display: flex;
    justify-content: center;
    overflow-x: hidden;
}

.whole-container{
    width: 100%;
    height: auto;
}
  

body{
    margin: 0;
    padding:  0;
    font-family: Verdana, sans-serif;
    display: flex;
    justify-content: center;
    overflow-x: hidden;
}





/* ------------------------ FLYER ---------------------- */



  .carousel {
    margin-left: 20%;
    position: relative;
    width: 23rem;
    height: 23rem;
    perspective: 500px;
    transform-style: preserve-3d;
    display: flex;
    align-items: center;
    justify-content: center;
    }
  
  .card-container {
    position: absolute;
    width: 100%;
    height: 100%;
    transform: 
      rotateY(calc(var(--offset) * 50deg)) 
      scaleY(calc(1 + var(--abs-offset) * -0.4))
      translateZ(calc(var(--abs-offset) * -30rem))
      translateX(calc(var(--direction) * -5rem));
    filter: blur(calc(var(--abs-offset) * 1rem));
    transition: all 0.3s ease-out;
    opacity: var(--opacity);
  }
  
  .card {
    width: 100%;
    height: 100%;
    padding: 2rem;
    background-color: hsl(280deg, 40%, calc(100% - var(--abs-offset) * 50%));
    border-radius: 1rem;
    color: #9CA3AF;
    text-align: justify;
    transition: all 0.3s ease-out;
  }
  
  .card img{
    width: 100%;
    object-fit: cover!important;
  }
  
  .nav {
    color: white;
    font-size: 3rem;
    position: absolute;
    top: calc(50% - 1.5rem);
    z-index: 2;
    cursor: pointer;
    user-select: none;
    background: none;
    border: none;
  }
  
  .nav i {
    vertical-align: middle;
  }
  
  .nav.left {
    color: #000;
    left: 1rem;
  }
  
  .nav.right {
    color: #000;
    right: 1rem;
  }

@media (max-width: 768px){
    .carousel {
        display: none;
    }
}


/* ----------------- Image Container ---------------------- */
.image-container {
    background-image: url('https://www.adventuredogphotography.com/wp-content/uploads/2023/09/0I7A9276.jpg');

    object-fit: cover;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    height: 500px;

    /*position: relative;
    text-align: center;*/
    
}

hr {
    background-color: #5A5A5A; /* Set the background color of the line */
    height: 1px; /* Adjust the height of the line */
    border: none; /* Remove any default border */
    margin-top: 30px;
}

/* Style for the overlaid text */
.image-text {
    position: absolute;
    top: 28%;
    left: 50%;
    transform: translate(-50%, -50%);
	color: white;
    padding: 10px;
    text-align: center;
}

/* Style for the text elements */
.image-text h1 {
    font-size: 25px;
    margin: 0;
    padding: 0;
}


.image-text p {
    font-size: 18px;
    margin: 0;
}

.whole-container{
    width: 100%!important;
    height: auto;
    display: flex;
    flex-direction: column;
}

.main-container{
	/*border: 1px solid black; */
	width: 70%;
	height: auto;
	margin-left: 200px;
	margin-top: 50px;
    margin-bottom: 50px;
}

.left-container{
    /*border: 1px solid black;*/ 
    width: 30%;
    height: 3859px;
    float: left;
}

.left-container img{
    width: 100%;
    height: auto;
}

.top-left-container{
	/*border: 1px solid black; */
	width: 100%;
	background-color: #f5f8fb;
	height: 230px;
	border-radius: 5px;
}

/* Style for button links */
.button-link {
    display: block;
    text-decoration: none;
    color: black;
    padding: 16.5px;
    transition: background-color 0.3s;
}

.button-link:hover {
    background-color:#527eff;
    text-decoration: none;
    color: white;
}

.middle-left-container{
    /*border: 1px solid black; */
    width: 100%;
    margin-top: 20px;
    background-color: #f5f8fb;
    height: 440px;
    border-radius: 5px;
}

.middle-left-container h3{
    color: #80298f;
    /*padding: 15px;*/
    position: relative;
    color: #80298f; /* Text color */
    padding: 20px; /* Add some space below the text */
    display: inline-block;
}

.middle-left-container h3::after {
    content: ""; /* Generate content for the pseudo-element */
    display: block;
    height: 3px; /* Set the height of the line */
    background-color: #80298f; /* Line color, same as text color */
    width: 30px; /* Adjust the width of the line */
    margin-top: 5px; /* Position the line below the text */
    border-radius: 10px;
}

.phone,
.email,
.location,
.clock {
    display: flex;
    align-items: center;
    margin-left: 20px;
}

.phone img,
.email img,
.location img,
.clock img {
    width: 30px;
    height: auto;
    margin-right: 10px;
}

.phone h6,
.email h6,
.location h6,
.clock h6 {
    margin: 0;
    margin-bottom: 20px;
    margin-left: 20px;
}

/* Add spacing between the icon and text */
.phone h6::before,
.email h6::before,
.location h6::before,
.clock h6::before {
    margin: 0 10px;
    color: #80298f;
}

/* Add spacing between the sections */
.phone, .email, .location {
    margin-bottom: 20px;
}

.phone p::before,
.email p::before,
.location p::before,
.clock p::before {
    margin: 0 10px;
    color: #80298f;
}

.phone p {
    margin: 0;
    margin-top: 30px;
    font-size: 14px; /* Adjust the font size as needed */
    margin-left: -56px;
}

.email p{
    margin: 0;
    margin-top: 30px;
    font-size: 14px; /* Adjust the font size as needed */
    margin-left: -47px;
}

.location p{
    margin: 0;
    margin-top: 30px;
    font-size: 14px; /* Adjust the font size as needed */
    margin-left: -75px;
}

.clock p {
    margin: 0;
    margin-top: 30px;
    font-size: 14px; /* Adjust the font size as needed */
    margin-left: -60px;
}

/* Style for the hr element separating content in the middle-left-container */
.middle-left-container hr {
    width: 100%; /* Adjust the width of the horizontal line */
    margin-top: 20px; /* Add spacing between content and horizontal line */
    margin-bottom: 20px; /* Add spacing between horizontal line and content */
}

/* Style for the bottom-left-container */
.bottom-left-container {
    width: 100%;
    margin-top: 25px;
    background-color: #f5f8fb;
    border-radius: 5px;
    padding: 20px;
    box-sizing: border-box!important;
    position: sticky!important;
    top: 0!important;
    transition: box-shadow 0.3s, background-color 0.3s;
}

.bottom-left-container:hover {
     /* Change the background color on hover */
    box-shadow: 0 0 10px 0 rgba(128, 41, 143, 0.7); /* Add a box shadow on hover */
}

.bottom-left-container h3{
    color: #80298f;
}

/* Style for the contact form */
.contact-form {
    margin-top: 35px;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    font-weight: bold;
    font-family: 'MyCustomFont', Arial, sans-serif;
    margin-bottom: 6px;
}

.form-group input {
    width: 90% !important;
    height: 40px!important;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}


.submit-button {
    background-color: #527eff;
    color: white;
    border: none;
    padding: 15px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 225px;
    height: 60px;
}

.submit-button:hover {
    background-color: #3055a5;
}

/* Style for the asterisk indicating required fields */
.required {
    color: red;
    margin-left: 4px; /* Adjust the spacing as needed */
}

/* This is the main right div*/
.right-container{
	/*border: 2px solid black;*/ 
	width: 66%;
	height: auto;
    float: right;
}

.right-container img{
    max-width: 100% !important;
    /*height: 420px;*/
    width: 100% !important;
    object-fit: cover !important;
}

/*.right-container img{
    max-width: 100%;
    height: 420px;
    width: 100%;
}*/

.right-container h1{
    color: #80298f;
}

.right-container-text{
    margin-top: 1%;
}

/* This is the 1st right div*/
/*.top-right{
	border: 1px solid black; 
	width: 100%;
	height: 250px;
}*/

/* ---------------- Basic Key facts Table ---------------------- */

table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }

    /* Zebra striping */
    tr:nth-of-type(odd) {
      background: #eee;
    }

    th {
      background: #80298f;
      color: white;
      font-weight: bold;
    }

    td, th {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: left;
      font-size: 18px;
    }

    @media only screen and (max-width: 760px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      th {
        display: none;
      }

      tr {
        margin-bottom: 10px;
      }

      td {
        border: none;
        border-bottom: 1px solid #ccc;
        font-size: .8em;
        position: relative;
        padding-left: 50%;
      }

      td:before {
        position: absolute;
        top: 6px;
        left: 6px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
        content: attr(data-column);
        color: #000;
        font-weight: bold;
      }
    }


.bold-text{
	font-weight: 700;
	font-family: "Poppins",Tahoma,Geneva,sans-serif;
	line-height: 1.6;
}

.normal-text{
	font-family: "Poppins",Tahoma,Geneva,sans-serif;
	line-height: 1.6;
}

.third-right-services ul {
    list-style-type: disc; /* Bullet point style */
    padding-left: 30px; /* Indentation for bullet points */
}

.third-right-services li {
    margin-bottom: 10px; /* Spacing between list items */
    font-family: "Poppins",Tahoma,Geneva,sans-serif;
}


@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

.contact-info{
  position: relative;
  height: 45px;
  width: 130px;
  margin: 0 20px;
  margin-top: 6px;
  font-size: 16px;
  font-weight: 300;
  letter-spacing: 1px;
  border-radius: 5px;
  text-transform: uppercase;
  border: 1px solid transparent;
  outline: none;
  cursor: pointer;
  background: #80298f;
  overflow: hidden;
  transition: 0.6s;
  font-family: 'Poppins',sans-serif;
  
}
.contact-info:first-child{
  color: #206592;
  border-color: #206592;
}
.contact-info:last-child{
  color: #fff;
}
.contact-info:before, .contact-info:after{
  position: absolute;
  content: '';
  left: 0;
  top: 0;
  height: 100%;
  filter: blur(30px);
  opacity: 0.4;
  transition: 0.6s;
}
.contact-info:before{
  width: 60px;
  background: rgba(255,255,255,0.6);
  transform: translateX(-130px) skewX(-45deg);
}
.contact-info:after{
  width: 30px;
  background: rgba(255,255,255,0.6);
  transform: translateX(-130px) skewX(-45deg);
}
.contact-info:hover:before,
.contact-info:hover:after{
  opacity: 0.6;
  transform: translateX(320px) skewX(-45deg);
}
.contact-info:hover{
  color: #f2f2f2;
}
.contact-info:hover:first-child{
  background: #206592;
}
.contact-info:hover:last-child{
  background: #ce5c0c;
}



.third {
  border-color:  #80298f; 
  color: #fff;
  width: 90%;
  height: 50px;
  box-shadow: 0 0 40px 40px  #80298f inset, 0 0 0 0 #80298f;
  transition: all 150ms ease-in-out;
}

.third:hover {
  box-shadow: 0 0 10px 0 #0074e4 inset, 0 0 10px 4px #0074e4;
  color: #000;
}

/* Adjust image size for smaller screens */
.image-container img {
    max-width: 100%;
    height: auto;
}



.c-button {
  color: #fff;
  font-weight: 700;
  font-size: 16px;
  text-decoration: none;
  padding: 0.9em 1.6em;
  cursor: pointer;
  display: inline-block;
  vertical-align: middle;
  position: relative;
  z-index: 1;
  margin-top: 2%;
}

.c-button--gooey {
  color: #80298f;
  border-color: #80298f!important;
  text-transform: uppercase;
  letter-spacing: 2px;
  border: 4px solid #06c8d9;
  border-radius: 0;
  position: relative;
  transition: all 700ms ease;
  margin-left: 10px;
  background-color: transparent;
}

.c-button--gooey .c-button__blobs {
  height: 100%;
  filter: url(#goo);
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 0;
  bottom: -3px;
  right: -1px;
  z-index: -1;
}

.c-button--gooey .c-button__blobs div {
  background-color: #80298f;
  width: 36%;
  height: 100%;
  border-radius: 100%;
  position: absolute;
  transform: scale(1.4) translateY(125%) translateZ(0);
  transition: all 700ms ease;
}

.c-button--gooey .c-button__blobs div:nth-child(1) {
  left: -5%;
}

.c-button--gooey .c-button__blobs div:nth-child(2) {
  left: 30%;
  transition-delay: 60ms;
}

.c-button--gooey .c-button__blobs div:nth-child(3) {
  left: 66%;
  transition-delay: 25ms;
}

.c-button--gooey:hover {
  color: #fff;
}

.c-button--gooey:hover .c-button__blobs div {
  transform: scale(1.4) translateY(0) translateZ(0);
}



.foot-container {
    margin-top: 18px; 
    /* background-color: #344871!important; */
    background-color: #3b103e;
    /* background-color: rgb(50, 31, 66); */
    border: 2px solid black;
    color: black;
    width: 100%;
    height: auto;
    justify-content: center;
    /* margin-bottom: 5px; */
    margin-bottom: 1%;
    padding: 1%;
}

footer {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-bottom: -1%;
  
}
.no_under{
  text-decoration: none !important;
 
}

.HeadText {
    font-family: Poppins, Arial,Helvetica,sans-serif;
    font-size: 20px!important;
    line-height: 36px!important;
    font-weight: 800!important;
    text-rendering: optimizeLegibility;
    color: rgb(255, 255, 255);
    margin-left: 20px;
    
}
.HeadText2{
  font-family: Poppins,Arial,Helvetica,sans-serif;
    font-size: 20px!important;
    line-height: 36px!important;
    font-weight: 800!important;
    text-rendering: optimizeLegibility;
    color: rgb(255, 255, 255);
    margin-left: 2px;
}

.quick-links-text-left {
  flex: 1;
  text-align: left;
  /* padding-left: 20px; */
}

.quick-links-text-left {
    font-size:14px;
    margin-left:20px; 
    /* color: #9faebe; */
    color: goldenrod;
    /* border: 2px black solid; */
    margin-top: 2%;
    transition: background-color 0.3s ease;
    
}

.quick-links {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.quick-links-logo{
  display: flex;
  flex-direction: row;
  gap: 15px;
  margin-left: 10px;
  /* border: 2px black solid; */
  height: 50% !important;
  width: 100% !important;
  /* justify-content: center;
  align-items: center; */
}
.services {
  display: flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
}

.Services-Text {
  /* color: #9faebe; */
  color: white;
  font-size: 14px;
  padding: 1px;
  transition: background-color 0.3s ease;
}
.Services-Text:hover{
  /* font-weight: bold; */
  color: gold;
}



/* Social media icons */
.bi-facebook,
.bi-instagram,
.bi-youtube,
.bi-tiktok,
.bi-linkedin {
  color: white;
 
  border: 1px solid white; 
  padding: 8%; 
  
}
.download-link{
  height: 35px;
  width: auto;

}
.quick-links-download{
  float: right;
  display: flex;
  flex-direction: row;
  gap: 10px;
  /* border: 2px black solid; */
  height: 25% !important;
  width: 100% !important;
  /* align-items: center;
  justify-content: center; */
}
.quick-links-seek{
  display: flex;
  flex-direction: row;
  gap: 10px;
  /* border: 2px black solid; */
  height: 100% !important;
  width: 100% !important;
  align-items: center;
  justify-content: center;
}
.Services{
  width: 20%;
  margin-top: 15px;
}
.arrow{
  margin-left:20px; 
  margin-bottom: 4px;
  color: white;
  
}
.arrow:hover{
  background-color: transparent !important;
  color: gold;
}
.bi{
  margin-top: 5px;
  transition: background-color 0.3s ease !important;
}
.bi:hover{
  color: gold;
  border-color: gold;
}
.copyright-text{
  float: left;
  width: 100%;
  /* background-color: purple; */
  height: 40px;
  margin-top: 2px;
  text-align: center;
  color: white;
  /* padding: 5px; */
}
.line {
  width: 90%;
  border: 1px solid white;
  margin-top: 40px;
  text-align: center;
  margin-left: 5%;
}
.line2{
  width: 100%;
  border: 1px solid black;
  margin-top: 10px;
  
 
}
.com-logo{
  /* float: right; */
  margin-right: 30px;
  margin-top: 10px;
  margin-bottom: 10px;
  margin-left: -5px;
}
.logo{
  width: 200px;
  height: 88.65px;
}

/* Mobile-first media query */
@media (max-width: 768px) {

    .whole-container{
        width: 100%;
        height: auto;
        overflow-x: hidden;
    }



    .main-container {
        width: 90%;
        margin: 0 auto;
        height: auto;

    }

    .left-container {
        width: 100%;
        float: none;
    }

    /* Modify button styles for smaller screens */
    .button-link {
        padding: 12px;
    }

    .bold-text{
        font-size: 14px!important;
    }

    .normal-text{
        font-size: 14px!important;
    }

    .image-text {
        top: 15%; /* Adjust vertical positioning for smaller screens */
        left: 50%; /* Center the text horizontally */
        transform: translate(-50%, 0);
        position: relative;
    }

    .image-text h1 {
        font-size: 28px; /* Reduce font size for smaller screens */
        position: relative;
    }

    .image-text p {
        font-size: 20px; /* Reduce font size for smaller screens */
        position: relative;
    }

    .top-left-container {
        height: auto; /* Adjust height for smaller screens, content will determine the height */
        float: none;
        width: 100%;
    }

    .middle-left-container{
        margin-top: 30px;
        margin-bottom: 30px;
        float: none;
        width: 100%;
    }

    .middle-left-container .phone img, .email img, .location img, .clock img {
        width: 30px;
        height: auto;
        margin-right: 1px;
    }

    .phone p {
        margin: 0;
        margin-top: 30px;
        font-size: 12px; /* Adjust the font size as needed */
        margin-left: -56px;
        font-size: 13px;
    }

    .email p{
        margin-top: 30px;
        font-size: 12px; /* Adjust the font size as needed */
        margin-left: -47px;
        font-size: 13px;
    }

    .location p{
        margin: 0;
        margin-top: 30px;
        font-size: 12px; /* Adjust the font size as needed */
        margin-left: -66px;
        font-size: 13px;
    }

    .clock p {
        margin: 0;
        margin-top: 30px;
        font-size: 12px; /* Adjust the font size as needed */
        margin-left: -53px;
        font-size: 13px;
    }

    .card{
        width: 300px;
        height: 200px;
        perspective: 1000px;
    }
    .card-inner{
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.999s;
    }

    .card:hover .card-inner{
        transform: rotateY(180deg);
    }

    .card-front, .card-back{
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
    }

    .card-front{
        transform: rotateY(0deg);
    }

    .card-back{
        transform: rotateY(180deg);
    }

    .bottom-left-container {
        position: static!important; /* This removes the sticky positioning for smaller screens */
        margin-top: 0; /* Remove the top margin */
        padding: 10px; /* Adjust padding as needed */
        width: 100%;
    }

    .right-container {
        margin-top: -1690px;
        width: 100%;
        height: auto;
    }

    .right-container h1{
        font-size: 24px;
        margin-bottom: 10px;
    }

    .right-container p{
        font-size: 14px;
        line-height: 24px;
        margin-top: 10px;
    }

    .form-group input{
        width: 94%;
    }

  

    

  /* Adjust the grid layout for smaller screens */
  .main {
     
      width: 100% !important;
      
      
  }
  .sub-main{
    width: 100% !important;
    float: left !important;
  }
  .sub-main2{
    
    width: 100% !important;
    float: left !important;
  }

  section {
      
      width: 100%;
  }
  .content-section{
    width: 100%;
    
    
  }

  .form-right {
    
      width: 100%;
      display:block;
     
  }
  .foot-container{
    margin-top: 14px;

    width: 100% !important;
    height: auto !important;
    float: left !important;
  
  }
  .HeadText{
    width: 100% !important;
  }

}

.centered-image {
    display: flex;
    justify-content: center;
    align-items: center;
    height: auto; /* Adjust the height as needed */
}

.centered-image img {
    max-width: 100%;
    max-height: 100%;
}
</style>


<div class="whole-container">
<div class="centered-image">
    <a href="{{ route('frontend.home') }}">
        <img src="{{ asset('logo/petspotter-logo.png') }}" style="max-width: 300px; height: auto;">
    </a>
</div><hr style= "margin-top: 0px; color: #000;">

<!------------------------- MAIN CONTAINER ------------------------->

    <div class="main-container">

<!------------------------ LEFT CONTAINER ------------------------->

        <div class="left-container">
            <img src="https://www.pawsbyzann.com/wp-content/uploads/2019/02/Bruce-Final-small.jpg">
            <div class="top-left-container">
                <a href="#universities" class="button-link">Veterinary Check-ups
                </a>
                <a href="#fees" class="button-link">Nutritional Needs of Pets</a>
                <a href="#admission" class="button-link">Role of Exercise</a>
                <a href="#life" class="button-link">Responsible Pet Ownership</a>
            </div>

<!--------------------- MIDDLE LEFT CONTAINER ------------------------->

            <div class="middle-left-container">
                <h3><b>Putalisadak</b></h3><br>
                <div class="phone">
                <i class="bi bi-telephone"></i>
                    <h6><strong>Phone</strong></h6>
                    <p>01-3455434</p>
                </div>
                <hr>
                <div class="email">
                <i class="bi bi-envelope"></i><h6><strong>Email</strong></h6>
                    <p>info@petspotter.com</p>
                </div>
                <hr>
                <div class="location">
                  <i class="bi bi-geo-alt"></i><h6><strong>Location</strong></h6>
                    <p>Ramshah Path, P.O. Box: 347</p>
                </div>
                <hr>
                <div class="clock">
                    <i class="bi bi-alarm"></i><h6><strong>Timing</strong></h6>
                    <p>Sun – Fri | 9:00 AM - 5:00 PM</p>
                </div>
            </div>

<!--------------------- BOTTOM LEFT CONTAINER ------------------------->

            <div class="bottom-left-container" id="contact-us">
                <h3>Contact us</h3>
                <form class="contact-form" action="#" method="post">
                    <div class="form-group">
                        <label for="name">Name<span class="required">*</span></label>
                        <input type="text" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Email<span class="required">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Subject<span class="required">*</span></label>
                        <input type="text" id="subject" name="subject" placeholder="Subject" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="current-city">Message<span class="required">*</span></label>
                        <textarea style="width: 250px;" id="message" name="message" rows="3" placeholder="Message..." required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="third"><b>Submit</b></button>
                    </div>
                </form>
            </div>
        </div>

<!------------------------ RIGHT CONTAINER --------------------------->

        <div class="right-container">
                <h1 id="universities">The Importance of Regular Veterinary Check-ups for Pets</h1>
                <img src="https://media.istockphoto.com/id/1423830925/photo/young-vet-using-tablet-pc-at-her-work.jpg?s=612x612&w=0&k=20&c=fBBv9PcVYkJVgKC0xhsGBK8Y-1eHP6B37cK8GOh0k8s="/>
                <p class="right-container-text">Regular veterinary check-ups are crucial for maintaining the health and well-being of pets. These check-ups allow veterinarians to detect any potential health issues early on, provide necessary vaccinations, and offer advice on nutrition, exercise, and preventive care. Through routine examinations, veterinarians can address any concerns pet owners may have and ensure that their pets receive the appropriate medical attention they need.</p>
           <hr>

                <h1 id="fees">Understanding the Nutritional Needs of Pets</h1>
                <img src="https://media.istockphoto.com/id/497384624/photo/hungry-dog.jpg?s=612x612&w=0&k=20&c=M72szeDZbo8bK160ch6UqvdgRY4RRRryxJGDB2ubT0c="/>
                <p class="right-container-text">Proper nutrition is essential for the overall health and longevity of pets. Pet owners should be knowledgeable about the nutritional requirements of their specific type of pet, whether it be a dog, cat, bird, or exotic animal. Understanding the importance of balanced diets, appropriate portion sizes, and the significance of feeding schedules can help prevent obesity, digestive issues, and other health problems in pets. Additionally, knowing how to read pet food labels and choose high-quality, species-appropriate food is key to providing optimal nutrition for pets.</p>

        <!------------------------- FLYER DISPLAY ------------------------->
            <div class="carousel">
                <div class="card-container">
                  <div class="card">
                    <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVwM8GByQ7buFlskRPQMG4mgIwqUXLwvL5bVfe_jQVRg&s" style="height: 300px;">
                    <div class="card-body">
                      
                    </div>
                  </div>
                </div>
                <div class="card-container">
                  <div class="card">
                    <img class="card-img-top" src="https://hips.hearstapps.com/hmg-prod/images/red-small-german-spitz-walking-in-the-autumn-park-royalty-free-image-1580496879.jpg" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                      
                      
                    </div>
                  </div>
                </div>
                <div class="card-container">
                  <div class="card">
                    <img class="card-img-top" src="https://paradepets.com/.image/t_share/MTkxMzY1Nzg5MjIyMzgxMDg5/portrait-pomeranian-dog.jpg" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                      
                      
                    </div>
                  </div>
                </div>
                <div class="card-container">
                  <div class="card">
                    <img class="card-img-top" src="https://www.thesprucepets.com/thmb/Ucm77yh5Y8OCTzHpJMeLxCfnJC0=/2182x0/filters:no_upscale():strip_icc()/portrait-of-female-syrian-hamster-buleczka-90340213-57fff1a55f9b5805c2b149c7.jpg" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                      
                    </div>
                  </div>
                </div>
                <div class="card-container">
                  <div class="card">
                    <img class="card-img-top" src="https://images.herzindagi.info/image/2021/Aug/tiny-pets-for-small-house-main.jpg" style="height: 300px;">
                    <div class="card-body">

                      
                    </div>
                  </div>
                </div>
                
                <button class="nav left" onclick="prevSlide()"><i class="bi bi-chevron-left"></i></button>
                <button class="nav right" onclick="nextSlide()"><i class="bi bi-chevron-right"></i></button>
              </div>

<hr>
              <h1 id="admission">The Role of Exercise and Mental Stimulation in Pet Care</h1>
                <img src="https://vetmed.tamu.edu/news/wp-content/uploads/sites/9/2018/05/20151001-hipdysplasia.jpg"/>
                <p class="right-container-text">Exercise and mental stimulation are essential components of pet care that contribute to a pet's physical health and emotional well-being. Regular physical activity helps maintain a healthy weight, builds muscle strength, and reduces the risk of obesity-related diseases in pets. Moreover, mental stimulation through interactive play, training exercises, and environmental enrichment activities can prevent boredom, decrease stress and anxiety, and promote cognitive function in pets. Understanding the importance of providing opportunities for both physical exercise and mental enrichment can enhance the overall quality of life for pets.</p>
                
        <hr>

<!-- class="fifth-right right-content" -->
            <!-- <div id="life"> -->
                <h1 id="life">Promoting Responsible Pet Ownership and Environmental Awareness</h1>
                <img src="https://media.istockphoto.com/id/1307238003/photo/life-is-good-with-a-faithful-friend-by-your-side.jpg?s=612x612&w=0&k=20&c=8hIZN_g0-WGVfuybu2API5DjVAoNB6QkgcRsWYY3QVM="/><br><br>
                    <p>Responsible pet ownership goes beyond providing food, shelter, and medical care for pets. It also involves being mindful of the impact pets have on the environment and taking steps to minimize their ecological footprint. This includes proper waste disposal, using eco-friendly pet products, and considering the environmental implications of pet-related activities such as grooming and transportation. Additionally, responsible pet ownership entails promoting adoption from shelters and rescues, spaying/neutering pets to reduce overpopulation, and advocating for humane treatment of animals in all aspects of society. By fostering environmental awareness and responsible pet ownership practices, individuals can contribute to creating a more sustainable and compassionate world for both pets and humans alike.</p>

<!--------------------- CLOUD BUTTON ------------------------->

            <center><button class="c-button c-button--gooey" id="connectButton"> Connect with us
                <div class="c-button__blobs">
                <div></div>
                <div></div>
                <div></div>
                </div>
            </button></center>
        </div>
        
    </div>

<!--------------------- FOOTER ------------------------->


</div>

<!--------------------- JAVASCRIPT ------------------------->





<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
    // Get all the links with class "button-link"
    var links = document.querySelectorAll(".button-link");

    // Loop through each link
    links.forEach(function (link) {
        // Add a click event listener to each link
        link.addEventListener("click", function (e) {
            // Prevent the default link behavior (scroll to top)
            e.preventDefault();

            // Get the target div's id from the link's href attribute
            var targetId = this.getAttribute("href").substring(1);

            // Find the target div by its id
            var targetDiv = document.getElementById(targetId);

            // Scroll to the target div with smooth behavior
            targetDiv.scrollIntoView({ behavior: "smooth" });
        });
    });
});

function scrollToDiv() {
        // Get a reference to the target <div> using its ID
        var bottomcontainer = document.getElementById("contact-us");

        // Use the scrollIntoView method to scroll to the target <div>
        bottomcontainer.scrollIntoView({ behavior: "smooth" });
    }

</script>

<!---------------------- PHONE NUMBER + FLAG ---------------------->

<script>
    var input = document.querySelector("#phone");
    intlTelInput(input, {
      initialCountry: "auto",
      geoIpLookup: function (success, failure) {
        $.get("https://ipinfo.io", function () { }, "jsonp").always(function (resp) {
          var countryCode = (resp && resp.country) ? resp.country : "np";
          success(countryCode);
        });
      },
    });
  </script>

<!---------------------- PHONE NUMBER + FLAG ---------------------->

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Get the "Connect with us" button element
  const connectButton = document.getElementById("connectButton");

  // Add a click event listener to the button
  connectButton.addEventListener("click", function() {
    // Use window.open to open the page in a new tab
    window.location.href = "{{ route('frontend.contact-us') }}"; // Replace "contact.html" with the actual URL of the page
  });
});


function focusFirstName() {
    document.getElementById("first-name").focus();
}
</script>

<!----------------- FLYER JS ------------------------>

 </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    let active = 1;
    const cardCount = $('.card-container').length;
    
    function prevSlide() {
      active = (active - 1 + cardCount) % cardCount;
      updateCarousel();
    }
    
    function nextSlide() {
      active = (active + 1) % cardCount;
      updateCarousel();
    }
    
    function updateCarousel() {
      $('.card-container').each(function(i) {
        const offset = ((active - i) % cardCount) / 3;
        const direction = Math.sign(active - i);
        const absOffset = Math.abs(active - i) / 3;
        const isActive = i === active ? 1 : 0;
        const opacity = Math.abs(active - i) <= 1 ? 1 : 0;
        
        $(this).css({
          '--offset': offset,
          '--direction': direction,
          '--abs-offset': absOffset,
          '--active': isActive,
          '--opacity': opacity
        });
      });
    }
    
    $(document).ready(function() {
      updateCarousel();
    });

</script>

</body>
</html>