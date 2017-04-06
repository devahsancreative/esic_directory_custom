
        <div class="row">
            <div class="col-md-12">
                <ol>
                    <?php 
                        if(isset($return) && !empty($return)){
                            foreach ($return as $key => $message) {
                                $message = explode('::', $message);
                                echo '<li>'.$message[1].'</li>' ;
                            }
                        }
                    ?>
                </ol>
            </div>
            <!-- /.col -->
        </div>