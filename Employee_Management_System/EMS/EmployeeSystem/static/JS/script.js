 $('#employee_name_search').on('submit', function(e){
         e.preventDefault();
           $.ajax({
                type : "GET",
                url: "search_results/",
                data: {
                 emp_name : $('#emp_name').val(),
                },
                
                success: function(data){
                  var employees = data.employees;
                  $("#employee_table_body").html("");
                  employees.forEach(function(employee){
                  var btn = '<form action="/employee_details/" method="GET"><input type="text" class="form-control" name="employee_id" value="'+ employee.employee_id.value +'" style="display:none"/>  <button type="submit" class="btn-details"> <i class="fas fa-arrow-right"></i> View Details</button></form>';
                  var row = "<tr><td style='width:200px'>"+ employee.name.value +"</td><td style='width:200px'>"+ employee.role_name.value +"</td><td style='width:200px'>"+ employee.branch_name.value +"</td><td style='width:200px'>"+ employee.level_name.value +"</td><td style='width:200px'>"+ employee.employment_type_name.value +"</td><td>"
                    if('project_name' in employee){
                      row += employee.project_name.value +"</td><td style='width:200px'>";
                    }else{
                       row += "</td><td  style='width:250px'>";
                    }
                    row += btn +"</td></tr>";
                    $("#employee_table_body").append(row);
                  });
                },

                failure: function() {}
            });
 });


 $('#employee_filter_search').on('submit', function(e){
         var role_n = $('#emp_role').val();
         e.preventDefault();
           $.ajax({
                type : "GET",
                url: "advance_search_results/",
                data: {
                 emp_name : $('#emp_name').val(),
                 emp_dept : $('#emp_dept').val(),
                 emp_role : $('#emp_role').val(),
                 emp_branch : $('#emp_branch').val(),
                 emp_employ_type : $('#emp_employ_type').val(),
                 emp_leave : $('#emp_leave').val(),
                },

                success: function(data){
                  var employees = data.employees;
                  $("#employee_table_body").html("");
                  employees.forEach(function(employee){
                  var btn = '<form action="/employee_details/" method="GET"><input type="text" class="form-control" name="employee_id" value="'+ employee.employee_id.value +'" style="display:none"/><button type="submit" class="btn-details"> <i class="fas fa-arrow-right"></i> View Details</button></form>';
                  var row = "<tr><td style='width:200px'>"+ employee.name.value +"</td><td style='width:200px'>"+ employee.role_name.value +"</td><td style='width:200px'>"+ employee.branch_name.value +"</td><td style='width:200px'>"+ employee.level_name.value +"</td><td style='width:200px'>"+ employee.employment_type_name.value +"</td><td>";
                    if('project_name' in employee){
                      row += employee.project_name.value +"</td><td style='width:200px'>";
                    }else{
                       row += "</td><td  style='width:250px'>";
                    }
                    row += btn +"</td></tr>"
                    $("#employee_table_body").append(row);
                  });
                  if ('roles' in data){
                    var roles = data.roles;
                    $("#emp_role").html("");
                    var option = "<option value=''>Select Role</option>";
                    $("#emp_role").append(option);
                    roles.forEach(function(role){
                      if(role_n == role.role_name.value && role_n !=""){
                        option = "<option value='" + role.role_name.value + "' selected>" + role.role_name.value + "</option>";
                      }else{
                        option = "<option value='" + role.role_name.value + "'>" + role.role_name.value + "</option>";
                      }
                      $("#emp_role").append(option);
                    });
                  }
                },
                failure: function() {}
            });
 });
