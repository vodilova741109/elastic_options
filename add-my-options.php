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
	// $pluginPrefix = "elastic-";
	// $pluginUrlScript = plugins_url('/elastic-front/includes/js/index.js');
	// wp_enqueue_script( "{$pluginPrefix}main", $pluginUrlScript, ['jquery'], '1.5' , true);
	
    
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

	$counter = 1;

     $counter++;
    // echo "elastic_hook_name_$counter";
	$elastic_hook_name_2 = get_option("elastic_hook_name_$counter");
	$elastic_wp_entity_2 = get_option("elastic_wp_entity_$counter");
	$elastic_class_2 = get_option("elastic_class_$counter");
	$elastic_method_2 = get_option("elastic_method_$counter");
	$elastic_api_endpoints_2 = get_option("elastic_api_endpoints_$counter");



    // Получает или выводит скрытое одноразовое поле (nonce) для формы.
	$updateOptions = wp_nonce_field('update-options');
	// массив с полученные значениями
	$elasticHooks = [$elastic_hook_name,$elastic_wp_entity, $elastic_class, $elastic_method, $elastic_api_endpoints,$elastic_hook_name_2, $elastic_wp_entity_2, $elastic_class_2, $elastic_method_2, $elastic_api_endpoints_2];
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
			<input type="hidden" name="page_options" value="elastic_hook_name,elastic_wp_entity,elastic_class,elastic_method, elastic_api_endpoints, elastic_hook_name_2,elastic_wp_entity_2,elastic_class_2,elastic_method_2,elastic_api_endpoints_2" />
            
			<p >
			<input type="button" onclick="add()" class="button-primary-main" value="Добавить" />
			</p>

			<p >
				<input type="button" onclick="get_el()" class="button-primary" value="Показать все" />
			</p>
	
	    	<h2>API Endpoints</h2>

			<table class="form-table table2" id="component_2">
				<tbody>
					<tr valign="top">
						<th scope="row">1</th>
						<td><input type="text" name="elastic_api_endpoints" value="$elastic_api_endpoints" /></td>
					</tr>
				</tbody>
				<tbody id='add_column'>				  
					<tr >
						<th scope="row">2</th>
						<td><input type="text" name="elastic_api_endpoints" value="$elastic_api_endpoints_2" /></td>						
					</tr>
					<tr >
					<th scope="row">3</th>
					<td><input type="text" name="elastic_api_endpoints" value="$elastic_api_endpoints_3" /></td>						
					</tr>
					<th scope="row">4</th>
					<td><input type="text" name="elastic_api_endpoints" value="$elastic_api_endpoints_4" /></td>						
					</tr>

				</tbody>

			</table>
				$hooks

				<p class="">
				<input type="button" onclick="add_2()" class="button-primary-main" value="Добавить" />
				</p>
		


				<p class="submit">
					<input type="submit" class="button-primary" value="Сохранить" />
				</p>


				
				<button onclick="clear_el()"> Очистить</button>
	
	</div>


EOT;


echo <<<EOT
	<script type="text/javascript">


	    let count = 1;	
		
		const btnSubmit = document.querySelectorAll('.button-primary-main');	
		let arrayBtn = [...btnSubmit];     

		const parent = document.getElementById('component');


		function add_element() {
			event.preventDefault();
			count++;
		
			const table = document.querySelector("table.table1");
			
			let tbody = document.createElement(`tbody`);

			tbody.innerHTML = `
						<tr>
						<th></th><th>Hook Name `+ count +`</th><th>WP Entity `+ count +`</th><th>Elastic Class `+ count +`</th><th>Elastic Method `+ count +`</th>
						</tr>
						<tr>
						<td> `+ count +`</td>
						<td><input type="text" id="4" name="elastic_hook_name_`+ count +`" value=" $elastic_hook_name_2 " /></td>
						<td><input type="text" name="elastic_wp_entity_`+ count +`" value=" $elastic_wp_entity_2 " /></td>
						<td><input type="text" name="elastic_class_`+ count +`" value="$elastic_class_2" /></td>
						<td><input type="text" name="elastic_method_`+ count +`" value=" $elastic_method_2 " /></td>
						</tr>
						`;
			table.append(tbody);
	
				parent.appendChild(tbody);
				save_element();

				function save_element(){
					const parsed = parent.innerHTML;
				
				}

			
		}

		function get_element() {
		
			parent.innerHTML = localStorage.getItem('hiDen');
			
		   
		}

		function clear_storage() {

		localStorage.setItem('hiDen', '');

		}

		window.add = add_element;
		window.get_el = get_element;
		window.clear_el = clear_storage;

		arrayBtn[0].addEventListener("click", (event) => {
	      
		});

        const add_column = document.getElementById('add_column');    

		arrayBtn[1].addEventListener("click", (event) => {
			event.preventDefault();

			add_column.style.display = "block";
				
		const table = document.querySelector("table.table2");


		let tbody = document.createElement(`tbody`);
		
			tbody.innerHTML = `<tr valign="top">
			<th scope="row"></th>
			<td><input type="text" id"7" name="elastic_api_endpoints_2" value="$elastic_api_endpoints_2" /></td>
			</tr>`;
			table.append(tbody);    
		});

	</script>
EOT;

}



?>
