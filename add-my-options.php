<?php

/**
 * @package Package name
 * @version 1.0
 */
/*
Plugin Name: Elastic Front add-my-options
Plugin URI: 
Description: Настройка Elastic Front
Armstrong: Elastic Front.
Author: Name Author
Version: 1.0
Author URI: 
*/
// подклюячение стилией и скриптов
add_action( 'admin_enqueue_scripts', function($hook) {
    wp_enqueue_style( 'my-wp-admin',  plugins_url('/elastic-front/includes/css/styles.css'));	
    
} );

// регистрация кастомного поля в админ-панеле с запуском функции с разметкой и добавлением данных
add_action('admin_menu', 'create_custom_panel');

function create_custom_panel() {
    add_menu_page('menu page', 'Elastic Front', 'manage_options', 'custom-panel', 'my_page_function',  plugins_url( 'elastic-front/elastic-op.svg' ), 65);
}

function my_page_function(){
	// переменные с БД
	
	$elastic_hook_name = get_option("elastic_hook_name");
	$elastic_wp_entity = get_option("elastic_wp_entity");
	$elastic_class = get_option("elastic_class");
	$elastic_method = get_option("elastic_method");
	$elastic_api_endpoints = get_option("elastic_api_endpoints");

  
	$elastic_add_2 = get_option("elastic_add_2");
	$elastic_add_3 = get_option("elastic_add_3");
	$elastic_add_4 = get_option("elastic_add_4");
	

    // Получает или выводит скрытое одноразовое поле (nonce) для формы.
	$updateOptions = wp_nonce_field('update-options');
	// массив с полученные значениями
	$elasticHooks = [$elastic_hook_name,$elastic_wp_entity, $elastic_class, $elastic_method, $elastic_api_endpoints, $elastic_add_2, $elastic_add_3, $elastic_add_4];
	// смкрытый импут для вывода массива со значениями
	foreach ($elasticHooks as $hook) {
		echo '<input type="hidden" name="hooks[]" value="'.$elasticHooks.'"';	
		
	}


echo <<<EOT
	<div class="wrap-container">
		<form method="post" action="options.php">{$updateOptions}		
	    	<h2>Hooks</h2>
	
			<table cellspacing="0" class="form-table table1" id="component" >
				<tbody name="my_options" >
					<tr>
					<th></th><th>Hook Name </th><th>WP Entity</th><th>Elastic Class</th><th>Elastic Method</th>
					</tr>
					<tr>
						<td>1</td>
						<td class="elem"><input type="text" id="na" name="elastic_hook_name" value=" $elastic_hook_name" /></td>
						<td><input type="text" name="elastic_wp_entity" value=" $elastic_wp_entity " /></td>
						<td><input type="text" name="elastic_class" value="$elastic_class" /></td>
						<td><input type="text" name="elastic_method" value=" $elastic_method " /></td>
					</tr>
				</tbody>  
			</table>
	
	
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="elastic_hook_name,elastic_wp_entity,elastic_class,elastic_method, elastic_api_endpoints, elastic_add_2, elastic_add_3, elastic_add_4" />
            


	    	<h2>API Endpoints</h2>

			<table class="form-table table2" >
				<tbody>
					<tr valign="top">
						<th scope="row">1</th>
						<td><input type="text" name="elastic_api_endpoints" value="$elastic_api_endpoints" /></td>
					</tr>
				</tbody>
			</table>

			<table class="form-table table2 d-none" id='add_column'>	
			
			<h2>Дополнительные настройки</h2>		
				<tbody >				
					<tr>
						<th scope="row">2</th>
						<td><input type="text" name="elastic_add_2" value="$elastic_add_2" /></td>						
					</tr>
					<tr >
					<th scope="row">3</th>
					<td><input type="text" name="elastic_add_3" value="$elastic_add_3" /></td>						
					</tr>
					<th scope="row">4</th>
					<td><input type="text" name="elastic_add_4" value="$elastic_add_4" /></td>						
					</tr>
				</tbody>

			</table>
				$hooks

				<p class="">
				<input type="button"  class="button-primary-main" value="Показать" />
				</p>
			

				<p class="submit">
					<input type="submit" class="button-primary" value="Сохранить" />
				</p>
		
	
	</div>


EOT;


echo <<<EOT
	<script type="text/javascript">	 		
		const btnSubmit = document.querySelector('.button-primary-main');	
		const add_column = document.getElementById('add_column');   
		btnSubmit.addEventListener("click", (event) => {
			event.preventDefault();
			add_column.classList.toggle("active");
			if(add_column.classList.contains("active")){				
				btnSubmit.value = 'Скрыть';
			} else{
				btnSubmit.value = 'Показать';
			}            
			add_column.classList.toggle("d-none");			
		
		});

	</script>
EOT;
// посмотреть все настройки
//  print_r($elasticHooks);

}



?>
