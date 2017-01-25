

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