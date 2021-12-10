"use strict";



const btnSubmit = document.querySelectorAll('.button-primary-main');




let arrayBtn = [...btnSubmit];


arrayBtn[0].addEventListener("click", (event) => {
  event.preventDefault();
  const table = document.querySelector("table.table1");
  // const tableDuble = document.querySelector(".table-duble");
  // tableDuble.style.display = 'block';

  let tbody = document.createElement(`tbody`);

  // let first_option = document.getElementById('first_option');
 
  tbody.innerHTML = `<tr valign="top">
        <th scope="row">1</th>
        <td> Hook Name 2 
        <input type="text" name="elastic_hook_name_2" value="$elastic_hook_name2" /></td>
        </tr>	 
        <tr valign="top">
        <th scope="row">2</th>
        <td> WP Entity 2 <input type="text" name="elastic_first" value="" /></td>
        </tr>
        <tr valign="top">
            <th scope="row">3</th>
            <td>Elastic Class 2 <input type="text" name="elastic_first" value="" /></td>
        </tr>
        <tr valign="top">
            <th scope="row">4</th>
            <td>Elastic Method 2 <input type="text" name="elastic_first" value="" /></td>
        </tr>`;
  table.append(tbody);
});


arrayBtn[1].addEventListener("click", (event) => {
    event.preventDefault();
    const table = document.querySelector("table.table2");
    const tableDuble = document.querySelector(".table2-duble");
    tableDuble.style.display = 'block';
    // let tbody = document.createElement(`tbody`);
  
    // let first_option = document.getElementById('first_option');
   
  //   tbody.innerHTML = `<tr valign="top">
	// <th scope="row">1</th>
	// <td><input type="text" id"7" name="my_option_second" value="" /></td>
	// </tr>`;
  //   table.append(tbody);    
  });


