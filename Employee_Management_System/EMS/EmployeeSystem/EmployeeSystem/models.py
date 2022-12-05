from SPARQLWrapper import SPARQLWrapper, JSON
import re


class SPARQLModel:
    def get_employees(self):
        # project = 'TraceCloud'
        # FILTER(?project = ems:""" + project + """)
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery("""
           PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
           SELECT ?employee_id ?name ?role_name ?branch_name ?employment_type_name ?project_name ?level_name
                WHERE{
                 ?ID a ems:Employees;
                  ems:id ?employee_id;
                  ems:name ?name;
                  ems:works_as ?emp_role;
                  ems:works_in ?branch;
                  ems:is_a ?employment_type;
                  ems:has_experience ?level.
                  ?emp_role ems:role_name ?role_name.
                  ?branch ems:branch_name ?branch_name.
                  ?level ems:level_name ?level_name.                  
                  ?employment_type ems:type ?employment_type_name. 
                  OPTIONAL { 
                     ?ID ems:works_on ?project.
                     ?project ems:project_name ?project_name.
                  }
                }
        """)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        employees = []
        for result in results["results"]["bindings"]:
            employees.append(result)
        return employees

    def get_roles(self):
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery("""
               PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
               PREFIX owl: <http://www.w3.org/2002/07/owl#>
               PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
               PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
               PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
               SELECT ?role_name WHERE {
                      ?role rdfs:subClassOf* ems:Roles;
                      rdfs:label ?role_name .
                      FILTER NOT EXISTS { 
                            FILTER CONTAINS(?role_name, 'Roles')
                      }
               }
        """)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        roles = []
        for result in results["results"]["bindings"]:
            roles.append(result)
        return roles

    def get_departments(self):
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery("""
               PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
               PREFIX owl: <http://www.w3.org/2002/07/owl#>
               PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
               PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
               PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
               SELECT ?department_name WHERE {
                      ?department rdfs:subClassOf ems:Departments;
                      rdfs:label ?department_name .
               }
        """)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        departments = []
        for result in results["results"]["bindings"]:
            departments.append(result)
        return departments

    def get_branches(self):
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery("""
               PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
               PREFIX owl: <http://www.w3.org/2002/07/owl#>
               PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
               PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
               PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
               SELECT ?branch_name WHERE {
                      ?branch rdfs:subClassOf ems:Branch;
                      rdfs:label ?branch_name .
               }
        """)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        branches = []
        for result in results["results"]["bindings"]:
            branches.append(result)
        return branches

    def get_levels(self):
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery("""
               PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
               PREFIX owl: <http://www.w3.org/2002/07/owl#>
               PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
               PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
               PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
               SELECT ?experience_name WHERE {
                      ?experience rdfs:subClassOf ems:Level;
                      rdfs:label ?experience_name .
               }
        """)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        levels = []
        for result in results["results"]["bindings"]:
            levels.append(result)
        return levels

    def get_employment_type(self):
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery("""
               PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
               PREFIX owl: <http://www.w3.org/2002/07/owl#>
               PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
               PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
               PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
               SELECT ?employment_name WHERE {
                      ?employment rdfs:subClassOf ems:Employment_Type;
                      rdfs:label ?employment_name .
               }
        """)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        employment_types = []
        for result in results["results"]["bindings"]:
            employment_types.append(result)
        return employment_types

    def get_education(self):
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery("""
               PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
               PREFIX owl: <http://www.w3.org/2002/07/owl#>
               PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
               PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
               PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
               SELECT ?education_name WHERE {
                   ?education rdfs:subClassOf ems:Education;
                   rdfs:label ?education_name .
               }
        """)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        education = []
        for result in results["results"]["bindings"]:
            education.append(result)
        return education

    def get_leaves(self):
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery("""
               PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
               PREFIX owl: <http://www.w3.org/2002/07/owl#>
               PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
               PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
               PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
               SELECT ?leave_name WHERE {
                      ?leave rdfs:subClassOf ems:Leaves;
                      rdfs:label ?leave_name .
               }
        """)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        education = []
        for result in results["results"]["bindings"]:
            education.append(result)
        return education

    def get_projects(self):
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery("""
               PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
               PREFIX owl: <http://www.w3.org/2002/07/owl#>
               PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
               PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
               PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
               SELECT ?project WHERE {
                      ?project rdf:type ems:Projects.
               }
        """)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        projects = []
        for result in results["results"]["bindings"]:
            projects.append(result)
        return projects

    def get_department_roles(self, department):
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        department = department.replace(" ", "_") + "_Roles"
        sparql.setQuery("""
                       PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
                       PREFIX owl: <http://www.w3.org/2002/07/owl#>
                       PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                       PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
                       PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
                       SELECT ?role_name WHERE {
                              ?role rdfs:subClassOf ems:""" + department + """;
                              rdfs:label ?role_name .
                       }
                """)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        roles = []
        for result in results["results"]["bindings"]:
            roles.append(result)
        return roles


    def search_employees(self, name):
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery("""
                PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
                SELECT ?name ?employee_id ?role_name ?branch_name ?employment_type_name ?project_name ?level_name
                WHERE{
                  ?ID a ems:Employees;
                  ems:name ?name;
                  ems:id ?employee_id;
                  ems:works_as ?emp_role;
                  ems:works_in ?branch;
                  ems:is_a ?employment_type;
                  ems:has_experience ?level.
                  ?emp_role ems:role_name ?role_name.
                  ?branch ems:branch_name ?branch_name.
                  ?level ems:level_name ?level_name.                  
                  ?employment_type ems:type ?employment_type_name. 
                  OPTIONAL { 
                     ?ID ems:works_on ?project.
                     ?project ems:project_name ?project_name.
                  }
                  FILTER CONTAINS(lcase(str(?name)), '""" + name.lower() + """')
                  }
                """)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        employees = []
        for result in results["results"]["bindings"]:
            employees.append(result)
        return employees

    def get_advance_search(filters):
        query_string = """PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
                SELECT ?name ?employee_id ?role_name ?branch_name ?employment_type_name ?project_name ?level_name ?leave_name
                WHERE{
                 ?ID a ems:Employees;
                  ems:name ?name;
                  ems:id ?employee_id;
                  ems:works_as ?emp_role;
                  ems:works_in ?branch;
                  ems:has_experience ?level;
                  ems:is_a ?employment_type.
                  ?emp_role ems:role_name ?role_name.
                  ?branch ems:branch_name ?branch_name.
                  ?level ems:level_name ?level_name.    
                  ?employment_type ems:type ?employment_type_name. 
                  ?department ems:has_role ?emp_role.
                   OPTIONAL {
                        ?ID ems:is_on ?leave.
                        ?leave ems:leave_name ?leave_name.
                     }
                    """
        if "branch" in filters:
            branch = filters['branch'].replace(' ', '_')
            query_string = query_string + "?branch a ems:" + branch + ".\n"
        if "department" in filters:
            dept = filters['department'].replace(" ", "_")
            query_string = query_string + " ?department a ems:" + dept + ".\n"
        if "role" in filters:
            # role = filters['role'].replace(" ", "")
            query_string = query_string + "FILTER (lcase(str(?role_name)) = '" + filters['role'].lower() + "')"
        if "employment_type" in filters:
            type = filters['employment_type'].replace(" ", "-")
            query_string = query_string + "?employment_type a ems:" + type + ".\n"
        if "leave" in filters:
            leave = filters['leave']
            query_string = query_string + "FILTER CONTAINS(lcase(str(?leave_name)),'" + leave.lower() + "')\n"
        if "name" in filters:
            name_con = "FILTER CONTAINS(lcase(str(?name)), '" + filters['name'].lower() + "')"
            query_string = query_string + name_con
        query_string += """OPTIONAL { 
                     ?ID ems:works_on ?project.
                     ?project ems:project_name ?project_name.
                    }
                  }"""
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery(query_string)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        employees = []
        for result in results["results"]["bindings"]:
            employees.append(result)
        return employees

    def employee_details(self, id):
        querystring = """
          PREFIX ems: <http://www.semanticweb.org/44734/ontologies/2021/10/EMS#>
                SELECT 
                 ?name ?salary ?employee_id ?branch_name ?role_name ?employment_type_name ?level_name ?country_name 
                 ?project_name ?education_name ?certifications_name ?leave_name ?department_name ?email ?start_date 
                 ?end_date ?hired_date ?phone
                 WHERE{
                    ?ID a ems:Employees;
                    ems:id ?employee_id;
                    ems:name ?name;
                    ems:works_as ?emp_role;
                    ems:works_in ?branch;
                    ems:works_for ?department;
                    ems:has_experience ?level;
                    ems:hired_date ?hired_date;
                    ems:lives_in ?country;
                    ems:has_completed ?education;
                    ems:is_a ?employment_type.
                    ?emp_role ems:role_name ?role_name.
                    ?country ems:country_name ?country_name.
                    ?branch ems:branch_name ?branch_name.
                    ?level ems:level_name ?level_name.    
                    ?employment_type ems:type ?employment_type_name.
                    ?country ems:country_name ?country_name.
                    ?department ems:department_name ?department_name.
                    ?education ems:degree_name ?education_name.
                    
                    OPTIONAL {
                       ?ID  ems:certified_as ?certifications.
                       ?certifications ems:certificate_name ?certifications_name.
                    }
                    OPTIONAL { 
                     ?ID ems:works_on ?project.
                     ?project ems:project_name ?project_name.
                     ?project ems:start_date ?start_date.
                     ?project ems:end_date ?end_date.
                    }
                    OPTIONAL { 
                     ?ID ems:is_on ?leave.
                     ?leave ems:leave_name ?leave_name.
                    }
                    OPTIONAL { ?ID ems:email_id ?email }
                    OPTIONAL { ?ID ems:phone_number ?phone }
                    OPTIONAL { ?ID ems:salary ?salary }
                    FILTER (?employee_id = '""" + id + """')
                    }"""
        sparql = SPARQLWrapper('http://localhost:3030/EMS/sparql')
        sparql.setQuery(querystring)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        employee = []
        for result in results["results"]["bindings"]:
            employee.append(result)
        return employee
