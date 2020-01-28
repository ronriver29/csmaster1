<style>
    .header{
        height:15%;
        background-color: #0033cc;
    }
    .header2{
        height:15%;
    }
    .header-img{
        width:9%;
        height:80%;
        margin-top:1.1%;
        padding-right:0.5%;
    }
    .header-csimg{
        width:14%;
        height:80%;
        /*margin-top:0.9%;*/
    }
    .header-container{
        padding-left: 18%;
        color:white;
    }
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background: linear-gradient(to bottom, #e8eff3 0%, #c6d3d1 100%);
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover {
        background: linear-gradient(to bottom, #e8eff3 0%, #999999 100%);
    }
    .topblue{
        height:1%;
        background-color: lightblue;
    }
    .tableclass{
        width:50%;
    }
</style>
<div class="header">
    <div class="header-container">
        <img style="float:left;" class="header-img" rel="icon" src="<?=base_url();?>/assets/img/cda.png" align="top">
            <p style="padding-top:2.7%;">
                REPUBLIC OF THE PHILIPPINES<br>
                <strong style="font-size: 120%;">COOPERATIVE DEVELOPMENT AUTHORITY</strong><br>
                CENTRAL OFFICE
            </p>
    </div>
</div>
<div class="header2">
    <img style="float:left;padding-left:20%;padding-right: 1%;" class="header-csimg" rel="icon" src="<?=base_url();?>/assets/img/CS-logo.png" align="top">
    <p style="padding-top:1.8%; font-family:helvetica;font-size: 260%;" align="top">
        COOPERATIVE SYSTEM</p>
        <!--<input type="text" placeholder="Search">Contact Us-->
</div>
<div class="topblue">
</div>
<div class="navbar">
    <ul>
        <li style="margin-left:37%;"><a class="active" href="#home">HOME</a></li>
        <li><a href="#cs">ABOUT CS PROJECT</a></li>
        <li><a href="#manual">USER'S MANUAL</a></li>
        <li><a href="#faqs">FAQS</a></li>
    </ul>
</div>
<center style="padding-top:2%;">
    <table class="tableclass">
        <tr style="font-size: 350%; font-family:helvetica;">
            <th><b>COOPRIS</b></th>
            <th><b>CAIS</b></th>
        </tr>
        <tr style="color:#595655;">
            <td><center>COOPERATIVE REGISTRATION<br>INFORMATION SYSTEM</center></td>
            <td><center>COOPERATIVE ASSESSMENT<br>INFORMATION SYSTEM</center></td>
        <tr>
        <tr style="font-family:helvetica;">
            <br><td><center><b><a style="text-decoration: none; color:black;" href="welcome/coopris" >CLICK HERE</a></b></center></td>
            <br><td><center><b><a style="text-decoration: none; color:black;" href="http://testsite.cmvsd.com/cais/users/login" >CLICK HERE</a></b></center></td>
        </tr>
    </table>
</center>