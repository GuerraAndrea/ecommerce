<?php
include("connection.php");
session_start();


                                    ?>
                                    <div class="reviews-submit">

                                        <h4>Lascia recensione:</h4>
                                        
                                        <form action="checkRec.php?id=<?php echo $_GET['id']; ?>&q=1" method="get">
                                            <div class="row form">
                                                <div class="col-sm-6">
                                                    <input type="title" name='titolo' placeholder="Titolo" required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo "<input type='hidden' name='id' value=" . $_GET['id'] . ">";
                                                    ?>
                                                </div>
                                               
                                                <div class="col-sm-12">
                                                    <textarea placeholder="Review" name='text' required></textarea>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button>Submit</button>
                                                </div>
                                        </form>