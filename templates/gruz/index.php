<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.gruz
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

// Output as HTML5
$doc->setHtml5(true);

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
//JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/bootstrap-1.js');

// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/bootstrap.css');

// Check for a custom CSS file
$userCss = JPATH_SITE . '/templates/' . $this->template . '/css/user.css';

if (file_exists($userCss) && filesize($userCss) > 0)
{
	$doc->addStyleSheetVersion('templates/' . $this->template . '/css/user.css');
}

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />

	<?php // Template color ?>
	<?php if ($this->params->get('templateColor')) : ?>
		<style type="text/css">
			body.site
			{
				border-top: 3px solid <?php echo $this->params->get('templateColor'); ?>;
				background-color: <?php echo $this->params->get('templateBackgroundColor'); ?>
			}
			a
			{
				color: <?php echo $this->params->get('templateColor'); ?>;
			}
			.nav-list > .active > a, .nav-list > .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .nav-pills > .active > a, .nav-pills > .active > a:hover,
			.btn-primary
			{
				background: <?php echo $this->params->get('templateColor'); ?>;
			}
		</style>
	<?php endif; ?>
	<!--[if lt IE 9]>
	<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">

<!-- Body -->
<div class="body">
	<!-- Header Contacts -->
	<div class="navbar-default">
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<?php if ($this->countModules('position-1')) : ?>
						<div class="nav-collapse">
							<jdoc:include type="modules" name="position-1" style="none" />
						</div>
					<?php endif; ?>
				</div>
				<div class="col-xs-6">
					<?php if ($this->countModules('position-1-1')) : ?>
						<div class="nav-collapse">
							<jdoc:include type="modules" name="position-1-1" style="none" />
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="header-main">
		<div class="container">
			<!-- logo -->
			<header class="logo" role="banner">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo-inner clearfix">
							<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
								<?php if ($this->countModules('logo')) : ?>
									<div class="logo">
										<jdoc:include type="modules" name="logo" style="none" />
									</div>
								<?php endif; ?>
								<!--
							<?php echo $logo; ?>
							<?php if ($this->params->get('sitedescription')) : ?>
								<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription')) . '</div>'; ?>
							<?php endif; ?>
							-->
							</a>
							<!--
                            <div class="header-search pull-right">
                                <jdoc:include type="modules" name="position-0" style="none" />
                            </div>
                            -->
						</div>
					</div>
					<div class="col-sm-6 hidden-xs cars">
						<?php if ($this->countModules('logo-right')) : ?>
							<div>
								<!-- Begin Right Sidebar -->
								<jdoc:include type="modules" name="logo-right" style="well" />
								<!-- End Right Sidebar -->
							</div>
						<?php endif; ?>
					</div>
					<div class="col-sm-2 hidden-xs">
						<?php if ($this->countModules('logo-contacts')) : ?>
							<div>
								<!-- Begin Right Sidebar -->
								<jdoc:include type="modules" name="logo-contacts" style="well" />
								<!-- End Right Sidebar -->
							</div>
						<?php endif; ?>
					</div>
				</div>
			</header>
		</div>
	</div>
	<?php if ($this->countModules('position-2')) : ?>
		<!-- Begin Sidebar
        <div class="navbar navbar-default">
            <div class="container">
                <div class="">
                    <jdoc:include type="modules" name="position-2" style="none" />
                </div>
            </div>
        </div>
        <!-- End Sidebar -->
		<nav class="navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="visible-xs"><a class="navbar-brand" href="/">UniksStroy</a></span>
				</div>
				<div class="container">
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<jdoc:include type="modules" name="position-2" style="none" />
					</div>
				</div>
			</div>
		</nav>
	<?php endif; ?>
	<div class="<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
		<!--
			<?php if ($this->countModules('position-1')) : ?>
				<nav class="navigation" role="navigation">
					<div class="navbar pull-left">
						<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
					</div>
				</nav>
			<?php endif; ?>
			-->
		<jdoc:include type="modules" name="banner" style="xhtml" />
		<div class="container">
			<main id="content" role="main" class="row <?php echo $span; ?>">
				<!-- Begin Content -->
				<jdoc:include type="modules" name="position-3" style="xhtml" />
				<jdoc:include type="message" />
				<jdoc:include type="component" />
				<!-- End Content -->
			</main>
			<?php if ($this->countModules('position-7')) : ?>
				<div id="aside" class="span3">
					<!-- Begin Right Sidebar -->
					<jdoc:include type="modules" name="position-7" style="well" />
					<!-- End Right Sidebar -->
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- Footer -->
<footer class="footer" role="contentinfo">
	<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
		<hr />
		<jdoc:include type="modules" name="footer" style="none" />
		<p class="pull-right">
			<a href="#top" id="back-top">
				<?php echo JText::_('TPL_GRUZ_BACKTOTOP'); ?>
			</a>
		</p>
		<p>
			&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
		</p>
	</div>
</footer>
<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
