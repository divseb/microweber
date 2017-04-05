<?php 

 
$breacrumb_params = array();


if(isset($params['current-page-as-root'])){
	$breacrumb_params['current-page-as-root'] = $params['current-page-as-root'];
}


$selected_start_depth =  get_option('data-start-from', $params['id']);
if($selected_start_depth){
	$breacrumb_params['start_from'] = $selected_start_depth;
}
//dd($breacrumb_params);
$data = breadcrumb($breacrumb_params);


$module_template = get_option('data-template', $params['id']);
    if ($module_template == false and isset($params['template'])) {
        $module_template = $params['template'];
    }
    if ($module_template != false) {
        $template_file = module_templates($config['module'], $module_template);
    } else {
        $template_file = module_templates($config['module'], 'default');
    }

    if (is_file($template_file) != false) {
        include($template_file);
    } else {
		
		$template_file = module_templates($config['module'], 'default');
		
		if(is_file($template_file) != false){
			include($template_file);
		} else {
			print lnotif(_e('No template found. Please choose template.', true));
		}

      
    }