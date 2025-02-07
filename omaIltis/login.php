<?php require_once('header.php'); ?>



<!-- page content -->



        <div class="wrapper-page">



            <div class="text-center">

                <a href="index.html" class="logo-lg"><i class="mdi mdi-radar"></i> <span>Minton</span> </a>

            </div>



            <form class="form-horizontal m-t-20" action="index.html">



                <div class="form-group row">

                    <div class="col-12">

                        <div class="input-group">

                            <div class="input-group-prepend">

                                <span class="input-group-text"><i class="mdi mdi-account"></i></span>

                            </div>

                            <input class="form-control" type="text" required="" placeholder="Username">

                        </div>

                    </div>

                </div>



                <div class="form-group row">

                    <div class="col-12">

                        <div class="input-group">

                            <div class="input-group-prepend">

                                <span class="input-group-text"><i class="mdi mdi-key"></i></span>

                            </div>

                            <input class="form-control" type="password" required="" placeholder="Password">

                        </div>

                    </div>

                </div>



                <div class="form-group row">

                    <div class="col-12">

                        <div class="checkbox checkbox-primary">

                            <input id="checkbox-signup" type="checkbox">

                            <label for="checkbox-signup">

                                Remember me

                            </label>

                        </div>



                    </div>

                </div>



                <div class="form-group text-right m-t-20">

                    <div class="col-xs-12">

                        <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">Log In

                        </button>

                    </div>

                </div>



                <div class="form-group row m-t-30">

                    <div class="col-sm-7">

                        <a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your

                            password?</a>

                    </div>

                    <div class="col-sm-5 text-right">

                        <a href="pages-register.html" class="text-muted">Create an account</a>

                    </div>

                </div>

            </form>

        </div>




<!-- END page content -->



<?php require_once('footer.php'); ?>