<?php

/**
 * @package Package name
 * @version 1.0
 */
/*
Plugin Name: Elastic Front add-my-options
Plugin URI: https://wp-admin.com.ua
Description: Настройка Elastic Front
Armstrong: Elastic Front.
Author: Name Author
Version: 1.0
Author URI: https://wp-admin.com.ua
*/
// подклюячение стилией и скриптов
add_action( 'admin_enqueue_scripts', function($hook) {
    wp_enqueue_style( 'my-wp-admin',  plugins_url('/elastic-front/includes/css/styles.css'));
	// $pluginPrefix = "elastic-";
	// $pluginUrlScript = plugins_url('/elastic-front/includes/js/index.js');
	// wp_enqueue_script( "{$pluginPrefix}main-js", $pluginUrlScript, ['jquery'], '1.5' , true);
	// mgAddMeta($pluginUrlScript);
    
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


	// $elastic_hook_name_2 = get_option("elastic_hook_name_2");
	// $elastic_wp_entity_2 = get_option("elastic_wp_entity_2");
	// $elastic_class_2 = get_option("elastic_class_2");
	// $elastic_method_2 = get_option("elastic_method_2");
	// $elastic_api_endpoints_2 = get_option("elastic_api_endpoints_2");

    // Получает или выводит скрытое одноразовое поле (nonce) для формы.
	$updateOptions = wp_nonce_field('update-options');
	// массив с полученные значениями
	$elasticHooks = [$elastic_hook_name,$elastic_wp_entity, $elastic_class, $elastic_method, $elastic_api_endpoints,$elastic_hook_name_2, $elastic_wp_entity_2, $elastic_class_2, $elastic_method_2, $elastic_api_endpoints_2];
	// смкрытый импут для вывода массива со значениями
	foreach ($elasticHooks as $hook) {
		echo '<input type="hidden" name="hooks[]" value="'.$elasticHooks.'"';		
	}
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<form action="options.php" method="POST">
			<?php
				settings_fields( 'option_group' );     // скрытые защитные поля
				do_settings_sections( 'elastic_front' ); // секции с настройками (опциями). У нас она всего одна 'section_id'
				submit_button();
			?>
		</form>
	</div>
	<?php





echo <<<EOT
	<div class="wrap-container">
		<form method="post" action="options.php">{$updateOptions}		
	    	<h2>Hooks</h2>
	
			<table cellspacing="0" class="form-table table1" >
				<tbody name="my_options" >
					<tr>
					<th></th><th>Hook Name </th><th>WP Entity</th><th>Elastic Class</th><th>Elastic Method</th>
					</tr>
					<tr>
						<td>1</td>
						<td class="elem"><input type="text" name="elastic_hook_name" value=" $elastic_hook_name  " /></td>
						<td><input type="text" name="elastic_wp_entity" value=" $elastic_wp_entity " /></td>
						<td><input type="text" name="elastic_class" value="$elastic_class" /></td>
						<td><input type="text" name="elastic_method" value=" $elastic_method " /></td>
					</tr>
				</tbody>  
                
				<p name="my_options" id="component">
				</p>

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
			</table>
				$hooks

				<p class="">
				<input type="button" onclick="add_2()" class="button-primary-main" value="Добавить" />
				</p>
				<p class="">
					<input type="button" onclick="get_el()" class="button-primary" value="Показать все" />
				</p>


				<p class="submit">
					<input type="submit" class="button-primary" value="Сохранить" />
				</p>


				
				<button onclick="clear_el()"> Очистить</button>
	
	</div>


EOT;


for ($counter = 1; $counter < 3; $counter++) {
	// echo $counter;
	$elastic_hook_name = get_option("elastic_hook_name");
	$elastic_wp_entity = get_option("elastic_wp_entity");
	$elastic_class = get_option("elastic_class");
	$elastic_method = get_option("elastic_method");
	$elastic_api_endpoints = get_option("elastic_api_endpoints");

echo <<<EOT
   
	<script type="text/javascript">
		const value_option = " $elasticHooks[0]";
	    let count = " $counter";
		console.log(count);
	
		
		const btnSubmit = document.querySelectorAll('.button-primary-main');	
		let arrayBtn = [...btnSubmit];
       

		const parent = document.getElementById('component');

		function add_element() {
			event.preventDefault();
			count++;
			console.log(count);
			
			const table = document.querySelector("table.table1");
			
			let tbody = document.createElement(`tbody`);

			tbody.innerHTML = `
						<tr>
						<th></th><th>Hook Name </th><th>WP Entity</th><th>Elastic Class</th><th>Elastic Method</th>
						</tr>
						<tr>
						<td> `+ count +`</td>
						<td><input type="text" name="elastic_hook_name_`+ count +`" value=" $elastic_hook_name_`+ count +`" /></td>
						<td><input type="text" name="elastic_wp_entity_2" value=" $elastic_wp_entity_2 " /></td>
						<td><input type="text" name="elastic_class_2" value="$elastic_class_2" /></td>
						<td><input type="text" name="elastic_method_2" value=" $elastic_method_2 " /></td>
						</tr>
						`;
			table.append(tbody);

			
				parent.appendChild(tbody);
				save_element();

				function save_element(){
					const parsed = parent.innerHTML;
					localStorage.setItem('hiDen', parsed);
				}

			// counter++;
			// console.log(counter);	
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


		arrayBtn[1].addEventListener("click", (event) => {
			event.preventDefault();
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
}

add_action('admin_menu', 'plugin_settings');
function plugin_settings(){
	// параметры: $option_group, $option_name, $sanitize_callback
	register_setting( 'option_group', 'el_option_name', 'sanitize_callback' );

	// параметры: $id, $title, $callback, $page
	add_settings_section( 'section_id', 'Основные настройки', '', 'elastic_front' );

	// параметры: $id, $title, $callback, $page, $section, $args
    $counter = 1;
	    $nameHook ='Hook Name';
		$nameOption = 'elastic_front_field' . $counter;
		$callbackOption = 'fill_elastic_front_field' . $counter;
        


		$nameHook ='Hook Name';
		$nameOption = 'elastic_front_field' . $counter;
		$callbackOption = 'fill_elastic_front_field' . $counter;

		$nameHook ='Hook Name';
		$nameOption = 'elastic_front_field' . $counter;
		$callbackOption = 'fill_elastic_front_field' . $counter;



		add_settings_field( $nameOption ,$nameHook, $callbackOption, 'elastic_front', 'section_id' );
        	// $counter++;	
		$nameWP ='WP Entity';
		$nameOption = 'elastic_front_field' . $counter++;
		$callbackOption = 'fill_elastic_front_field' . $counter++;


		add_settings_field($nameOption, $nameWP, $callbackOption, 'elastic_front', 'section_id' );
		add_settings_field('elastic_front_field3', 'Elastic Class', 'fill_elastic_front_field3', 'elastic_front', 'section_id' );
		add_settings_field('elastic_front_field4', 'Elastic Method', 'fill_elastic_front_field4', 'elastic_front', 'section_id' );

	for ($counter = 1; $counter < 2; $counter++) {
	}


}

## Заполняем опцию 1
function fill_elastic_front_field1(){
	$val = get_option('el_option_name');	
	$val = $val ? $val['hook_name'] : null;
	?>
	<input type="text" name="el_option_name[hook_name]" value="<?php echo esc_attr( $val ) ?>" />
	<?php
}
function fill_elastic_front_field2(){
	$val = get_option('el_option_name');	
	$val = $val ? $val['input'] : null;
	?>
	<input type="text" name="el_option_name[input]" value="<?php echo esc_attr( $val ) ?>" />
	<?php
}
function fill_elastic_front_field3(){
	$val = get_option('el_option_name');	
	$val = $val ? $val['input'] : null;
	?>
	<input type="text" name="el_option_name[input]" value="<?php echo esc_attr( $val ) ?>" />
	<?php
}
function fill_elastic_front_field4(){
	$val = get_option('el_option_name');	
	$val = $val ? $val['input'] : null;
	?>
	<input type="text" name="el_option_name[input]" value="<?php echo esc_attr( $val ) ?>" />
	<?php
}



## Очистка данных
function sanitize_callback( $options ){
	// очищаем
	foreach( $options as $name => & $val ){
		if( $name == 'input' )
			$val = strip_tags( $val );

		if( $name == 'checkbox' )
			$val = intval( $val );
	}

	die(print_r( $options )); // Array ( [input] => aaaa [checkbox] => 1 )

	return $options;
}

?>
