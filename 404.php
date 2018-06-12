<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 3.3.7
 * @autor 		Babobski
 */
?>
<?php BsWp::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div class="container-fluid error-page">
    <div class="jumbotron text-center">
        <div class="row">
            <div class="col-md-12">
                <div class="sj-error-header">
        <h1>
            <i class="fa fa-frown-o red"></i> 404 Not Found
        </h1>
        <p class="lead">
            The page or resource you're looking for can't be found
        </p>
        <a class="btn btn-default btn-lg" href="/">Go home</a>
    </div>
            </div>
        </div>
    </div>
    <div class="container page-body">
        <div class="row">
            <div class="col-md-12">
                <div class="sj-error-body">
        <div class="row">
            <div class="col-md-6">
                <h2>What happened?</h2>
                <p class="lead">
                    A 404 error status implies that the file or page that you're looking for could
                    not be found.
                </p>
            </div>
            <div class="col-md-6">
                <h2>What can I do?</h2>
                <p class="lead">
                    If you think this is an error and that this page/resource should exist, please
                    contact ScholarJet support.
                </p>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</div>

<?php BsWp::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
