<?php
/*echo "<pre>";
var_dump($links);
echo "</pre>";
*/?>

<style type="text/css">
    #wrap {
        margin: 0 auto;
        max-width: 1000px;
        position: relative;
        width: 1000px;
        font-family: open sans, arial, san serif !important;
    }

    div.content {
        background: #fff none repeat scroll 0 0;
        display: inline-block;
        margin: 0 auto;
        padding: 20px 0 0;
        position: relative;
        width: 100%;
    }

    div#search-left {
        padding: 0;
        width: 255px;
    }

    div#search-left {
        background: transparent none repeat scroll 0 0;
        color: #1987a2;
        display: inline-block;
        float: none;
        padding: 0 10px;
        width: 250px;
    }

    .new-results {
        display: block;
        float: right;
        margin-left: 15px;
        margin-right: 10px;
        padding-bottom: 40px;
        position: relative;
        width: 705px;
    }

    .module {
        padding-left: 20px;
    }

    .module {
        border-color: rgba(152, 199, 80, 1);
    }

    .module {
        background: #424242 none repeat scroll 0 0;
        border-color: #82b1ff;
        border-radius: 0;
        border-style: solid;
        border-width: 3px 0 0;
        box-shadow: none;
        color: #fff;
        display: inline-block;
        float: left;
        margin-bottom: 25px;
        padding: 10px 15px;
        position: relative;
        width: calc(100% - 30px);
    }

    .module .module-section {
        padding-bottom: 10px;
    }

    .module h2, .module h3, .module h4 {
        font-size: 18px;
        font-weight: 400;
        letter-spacing: -1px;
        line-height: 1em;
        margin-bottom: 10px !important;
        text-align: center;
    }

    .module h3 {
        font-size: 18px;
        font-weight: 600;
        line-height: 28px;
        margin-bottom: 20px !important;
        margin-top: 10px;
        text-align: center;
    }

    .hcard-search {
        margin-top: 20px;
    }

    .hcard-search {
        border-bottom: 1px dotted #ccc;
        font-size: 12px;
        height: auto !important;
        line-height: 16px;
        padding: 10px 0;
        position: relative;
        width: 700px;
    }

    .info-type {
        color: #737373;
        font-size: 16px;
    }

    .module #filter label {
        display: block;
        font-size: 14px;
        line-height: 1.5em;
        margin-top: 5px;
    }

    .hcard-search span.hcard-name {
        border: 0 none;
        font-family: inherit;
        font-style: inherit;
        font-weight: inherit;
        letter-spacing: 0;
        margin: 0;
        outline: 0 none;
        padding: 0;
        text-decoration: none;
        vertical-align: baseline;
        color: #000000;
        font-size: 20px;
    }

    table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    p, ul, ol, table, dl {
        margin: 0;
        padding: 0;
    }

    td, tr, th {
        padding: 0;
        vertical-align: top;
    }

    a {
        color: #0084b4;
        text-decoration: none;
    }

    .price-assuarance, .price-funded {
        float: left;
        padding-bottom: 17px;
        padding-top: 15px;
        text-align: center;
    }
    div.sort b {
        margin: 0 3px 0 0;
    }
    #sort div.sort a:hover, div.sort b {
        background: #fdfdfd none repeat scroll 0 0;
        border: 1px solid #c9c9c9;
        border-radius: 3px;
        box-shadow: none;
        color: #404040;
        padding: 2px 5px;
    }
    strong, th, thead td, dt, b, caption {
        font-weight: 600;
    }
    div#sort div.sort {
        color: #999;
        display: inline-block;
        float: left;
        width: auto;
    }
    div.sort b {
        margin: 0 3px 0 0;
    }
    #sort div.sort a:hover, div.sort b {
        background: #fdfdfd none repeat scroll 0 0;
        border: 1px solid #c9c9c9;
        border-radius: 3px;
        box-shadow: none;
        color: #404040;
        padding: 2px 5px;
    }
    #sort div.sort a, #sort div.sort a:visited {
        /*background: #f3f3f3 none repeat scroll 0 0;*/
        background: #424242 none repeat scroll 0 0;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-left: 0;
        margin-right:3px;
        padding: 2px 5px;
        text-decoration: none;
        color:#fff;
        /*text-shadow: -1px 1px 1px #fff;*/
    }
    .clear {
        clear: both !important;
        float: none !important;
        font-size: 1px;
        height: 0;
        line-height: 0;
    }
    div#sort {
        color: #666;
        display: inline-block;
        margin: 20px 0;
        position: relative;
        width: 100%;
    }
    .featured-green {
        background-color: #4caf50;
        box-shadow: none;
        color: #ffffff;
        float: right;
        font-size: 12px;
        font-weight: bold;
        padding: 5px 10px;
    }
    .featured-yellow {
        background-color: #ffff00;
        box-shadow: none;
        color: #000000;
        float: right;
        font-size: 12px;
        font-weight: bold;
        padding: 5px 10px;
    }
    .module .hero-link {
        padding: 0;
        width: calc(100% - 2px);
    }
    .module .hero-link, .module .yellow-link {
        display: inline-block;
    }
    .hero-link {
        background: #a9a9a9 none repeat scroll 0 0;
        border: medium none;
        border-radius: 3px;
        box-shadow: none;
        color: #fff !important;
        cursor: pointer;
        display: inline-block;
        font-family: "Open Sans",sans-serif;
        font-size: 18px;
        line-height: 2em;
        padding: 0 20px;
        text-align: center;
        text-decoration: none !important;
        text-shadow: none;
        text-transform: capitalize !important;
        transition: all 175ms ease-in 0s;
    }
    .module p {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5em;
        margin-bottom: 10px;
        margin-top: -3px;
    }
</style>

<div class="content-shell">

    <div class="content-wrap" id="wrap">
        <div class="content">

            <style type="text/css"> .search-tabs div {
                    clear: both;
                    display: none;
                    position: relative;
                }

                .search-tabs div.active {
                    border-radius: 0 5px 5px 5px;
                    clear: both;
                    padding: 6px 10px;
                    display: block;
                    position: relative;
                    top: -2px;
                    z-index: 20;
                }

                .search-tabs {
                    margin: 0 0px 25px 10px;
                    position: relative;
                    width: 710px;
                }

                .location-content div {
                    display: block;
                    visibility: visible;
                }

                .location-content table {
                    width: 100%;
                }

                .location-content p {
                    text-align: left;
                    padding-left: 10px;
                    padding-bottom: 8px;
                }

                .location-content li {
                    margin-left: 20px;
                    margin-bottom: 5px;
                }

                .location-content ul {
                    margin-left: 20px;
                }

                .main-tabs {
                    border-bottom: 1px dotted #C9D7C0;
                    float: left;
                    width: 100%;
                }

                .main-tabs li.active a, .main-tabs li.active a:hover {
                    background: #ffffff;
                    background-color: #ffffff;
                    background-image: -ms-linear-gradient(top, #EEEEEE 0%, #FFFFFF 50%);
                    background-image: -moz-linear-gradient(top, #EEEEEE 0%, #FFFFFF 50%);
                    background-image: -o-linear-gradient(top, #EEEEEE 0%, #FFFFFF 100%);
                    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #EEEEEE), color-stop(1, #FFFFFF));
                    background-image: -webkit-linear-gradient(top, #EEEEEE 0%, #FFFFFF 50%);
                    background-image: linear-gradient(to bottom, #EEEEEE 0%, #FFFFFF 50%);
                    color: #000000;
                    font-weight: bold;
                    height: 30px;
                }

                /* Custome CSS - Edited */

                h1.homepage, .page-body h1, h1.hero {
                    font-size: 26px;
                    text-transform: capitalize;
                }

                .hcard-search {
                    margin-top: 20px;
                }

                .hcard-search span.hcard-name {
                    font-size: 20px;
                    color: #000000;
                }

                .hcard-search span.hcard-name:hover {
                    text-decoration: underline;
                }

                .hcard-search td.info {
                    font-size: 14px;
                    line-height: 19px;
                    padding-right: 10px;
                    width: 500px;
                }

                .info-type {
                    color: #737373;
                    font-size: 16px;
                }

                .info-city {
                    color: #737373;
                    font-size: 13px;
                    padding: 10px;
                }

                .info-price {
                    color: #000000;
                    font-size: 15px;
                    font-weight: bold;
                    text-align: left;
                    text-transform: uppercase;
                    padding-top: 20px;
                    padding-bottom: 20px;
                    margin-right: 20px;
                    margin-bottom: 20px;
                    margin-top: 20px;
                    line-height: 18px;
                }

                /*.info-price p {
                    float:left;
                    text-align: right;
                    margin-right:50px;
                }*/
                .hcard-search td.first-cell img {
                    background: none repeat scroll 0px 0px #FFF;
                    border: none;
                    border-radius: 0;
                    box-shadow: none;
                    margin-right: 20px;
                    padding: 0;
                    width: 200px;
                }

                .featured-red {
                    float: right;
                    font-size: 12px;
                    font-weight: bold;
                    color: #FFFFFF;
                    padding: 5px 10px;
                    background-color: #e71a1a;
                    box-shadow: none;
                }

                .price-prof {
                    color: #96c847;
                    font-size: 20px;
                    font-weight: bold;
                    padding-top: 10px;
                    margin-bottom: 10px;
                    line-height: 2.1rem;
                }

                .price-assuarance, .price-funded {
                    float: left;
                    text-align: center;
                    padding-bottom: 17px;
                    padding-top: 15px;
                }

                .assuarance {
                    color: #000000;
                    font-size: 12px;
                    padding: 7px 20px;
                    margin-right: 10px;
                    /*	border-radius: 5px 5px 5px 5px;
                    -moz-border-radius: 5px 5px 5px 5px;
                    -webkit-border-radius: 5px 5px 5px 5px;*/
                    border: 1px solid #000000;
                }

                /*.price-funded {
                    line-height: 2rem;
                }*/
                .funded {
                    font-size: 11px;
                    color: #FFFFFF;
                    padding: 8px 20px;
                    margin-right: 10px;
                    background-color: #838383;
                    text-transform: uppercase;
                    border: 1px solid #838383;
                }

                @media only screen and (max-width: 800px) {
                }

                @media only screen and (max-width: 480px) {
                    .hcard-search td.first-cell img {
                        margin-right: 0;
                        margin-left: 0;
                    }

                    .featured-red, .price-assuarance, .price-funded, .info-price, .price-prof {
                        float: none;
                    }

                    .featured-mobile {
                        display: block;
                    }

                    .funded, .assuarance, .info-price, .price-prof {
                        display: block;
                        margin-bottom: 8px;
                        text-align: center;
                    }

                    .hcard-search span.hcard-name {
                        margin-top: 10px;
                        display: block;
                        overflow: visible;
                    }

                    .info-type {
                        margin-top: 15px;
                    }

                    .price-prof {
                        padding-top: 0;
                        padding-bottom: 0;
                    }

                    .info-price {
                        padding-top: 0;
                        padding-bottom: 0;
                        margin-right: 0;
                    }
                }
            </style>
            <div class="clear"></div>
            <div class="new-results" id="regList">


                <style type="text/css"> .hcard-search .last {
                        display: none;
                    } </style>
                <div class="showing">
                    <?= isset($pageInfo)?$pageInfo:'' ?>
                    <!--Showing 1 - 10 of
                    52 Results-->
                    <!--                    <div class="sort_by">
                                            <select id="sortbox" onchange="window.location='/search_results?q=&amp;sort='+this.value;" name="sort" style="float:none;margin-left:4px;">

                                                <option selected="selected" value="distance">Closest to me</option>

                                                <option value="users_data.subscription_id DESC, user_id DESC">Most Recent</option>
                                                <option value="reviews">FEATURED</option>
                                                <option value="name ASC">Name A-Z</option>
                                                <option value="name DESC">Name Z-A</option>
                                            </select>
                                        </div>-->

                </div>


                <?php

                if(!empty($usersResult) && is_array($usersResult)){
                    foreach($usersResult as $key=>$user){
                ?>
                        <div class="hcard-search member_level_5">
                            <table width="100%" border="0">
                                <tbody>
                                <tr>
                                    <td valign="top">
                                        <table width="100%" border="0">
                                            <tbody>
                                            <tr>
                                                <td class="first-cell">
                                                    <a href="/england/newcastle-upon-tyne/e-commerce-markets/janet-stansfield"
                                                       title="Janet Stansfield SEIS Companies" rel="nofollow">
                                                        <img
                                                            src="<?=(isset($user['Logo']) and !empty($user['Logo']) and is_file(FCPATH.'/'.$user['Logo']))? base_url($user['Logo']):base_url('pictures/defaultLogo.png'); ?>"
                                                            alt="" class="left">
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table width="100%" border="0">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <table width="100%" border="0">
                                                        <tbody>
                                                        <tr>
                                                            <td height="30">
                                                                <a href="/england/newcastle-upon-tyne/e-commerce-markets/janet-stansfield">
                    <span class="hcard-name">
                            <?= $user['FullName'] ?>
                    </span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div class="featured-mobile"><p>
                                                                        <?=!empty($user['Status'])?$user['Status']:'' ?><br>
                                                                    </p></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="info-type"> <?=$user['Company']?></p>
                                                            </td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span class="price-funded">  </span>
                                                                <span class="price-assuarance"> <?=!empty($user['Web'])?'<span class="assuarance">'.$user['Web'].'</span>':'';?></span>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="info">
                                                    <table>
                                                        <tbody>
                                                        <tr>
                                                            <?=!empty($user['BusinessShortDesc'])?'<p>'.$user['BusinessShortDesc'].'</p>':'';?>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
            <?php
                    }
                }

                ?>

                <div class="clear"></div>
                <div id="sort">
                    <div class="sort">
                        <?=$links?>
                    </div>
                </div>


                <div class="clear"></div>
            </div>

            <!--- Left Sidebar --->

            <div id="search-left">

                <style type="text/css"> .module {
                        padding-left: 20px;
                    }

                    .module hr {
                        margin-left: -20px;
                        width: 115.5%;
                    }

                    .module .module-section {
                        padding-bottom: 10px;
                    }

                    .module-section .selectors {
                        margin-top: -10px;
                        margin-bottom: 20px;
                    }

                    .module-section .selectors a:hover {
                        text-decoration: underline;
                    }

                    .module h3 {
                        font-size: 18px;
                        font-weight: 600;
                        line-height: 28px;
                        margin-bottom: 20px !important;
                        margin-top: 10px;
                        text-align: left;
                        text-align: center;
                    }

                    .search-linker {
                        font-size: 14px;
                    }

                    .search-linker:hover {
                        text-decoration: underline;
                    }

                    .select2-container {
                        width: 100%;
                    }

                    .select2-container .select2-choice {
                        max-width: 286px;
                        width: calc(100% - 10px);
                    }

                    #filter input[type="text"] {
                        background: #FFFFFF;
                        background-color: #FFFFFF;
                        background-image: -ms-linear-gradient(top, #EEEEEE 0%, #FFFFFF 100%);
                        background-image: -moz-linear-gradient(top, #EEEEEE 0%, #FFFFFF 100%);
                        background-image: -o-linear-gradient(top, #EEEEEE 0%, #FFFFFF 100%);
                        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #FC3620), color-stop(1, #FFFFFF));
                        background-image: -webkit-linear-gradient(top, #EEEEEE 0%, #FFFFFF 100%);
                        background-image: linear-gradient(to bottom, #EEEEEE 0%, #FFFFFF 100%);
                        width: calc(100% - 6px);
                        max-width:193px;
                        padding: 5px 10px;
                    }

                    #profile #search-left {
                        padding-left: 0;
                    }

                    /* CSS for Selector Area*/

                    a.sub {
                        padding-left: 0;
                    }


                </style>
                <div class="module">
                    <div class="module-section">
                        <h3>Search by Location</h3>
                        <form method="get" accept-charset="UTF-8" action="/search_results">
                            <div class="filter3" id="filter">
                                <label>Search:</label>
                                <input type="text" value="" name="location_value" id="location_search"
                                       class="locationSuggest ac_input" placeholder="Name, website, company"
                                       autocomplete="off">
                            </div>
                            <div id="filter_submit">
                                <label>&nbsp;</label>
                                <input type="submit" class="hero-link green-bg" value="Search Now">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="module">
                    <h2>Get Listed</h2>
                    <p>
                        <b>1.</b> Select a Membership<br>
                        <b>2.</b> Create a searchable profile<br>
                        <b>3.</b> Connect with investors
                    </p>
                    <a class="hero-link green-bg" href="/join" title="Get Listed Now">Get Listed Now</a>
                </div>
                <div class="clear"></div>

            </div>

            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>