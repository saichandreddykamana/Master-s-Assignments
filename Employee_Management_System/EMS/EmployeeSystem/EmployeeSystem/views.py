from django.http import HttpResponse, JsonResponse
from django.shortcuts import render
from .models import SPARQLModel


def index(request):
    employees = SPARQLModel().get_employees()
    roles = SPARQLModel().get_roles()
    departments = SPARQLModel().get_departments()
    levels = SPARQLModel().get_levels()
    leaves = SPARQLModel().get_leaves()
    employment_types = SPARQLModel().get_employment_type()
    education = SPARQLModel().get_education()
    branches = SPARQLModel().get_branches()
    projects = SPARQLModel().get_projects()
    return render(request, 'home.html', {'roles': roles, 'departments': departments, 'levels': levels, 'leaves': leaves,
                                         'employment_type': employment_types, 'education': education,
                                         'branches': branches, 'projects': projects, 'employees': employees})


def description(request):
    if request.method == 'GET':
        if request.GET['employee_id'] != "":
            employee = SPARQLModel().employee_details(id=request.GET['employee_id'])
            return render(request, 'description.html', {'employee': employee})
    return render(request, 'description.html')


def search_results(request):
    if request.method == 'GET':
        if request.GET['emp_name'] != "":
            employees = SPARQLModel().search_employees(request.GET['emp_name'])
        else:
            employees = SPARQLModel().get_employees()
        response = {'employees': employees}
        return JsonResponse(response)


def advance_search(request):
    if request.method == 'GET':
        filters = {}
        if request.GET['emp_name'] != "":
            filters['name'] = request.GET['emp_name']
        if request.GET['emp_dept'] != "":
            filters['department'] = request.GET['emp_dept']
            roles = SPARQLModel().get_department_roles(department=filters['department'])
        else:
            roles = SPARQLModel().get_roles()
        if request.GET['emp_role'] != "":
            filters['role'] = request.GET['emp_role']
        if request.GET['emp_branch'] != "":
            filters['branch'] = request.GET['emp_branch']
        if request.GET['emp_employ_type'] != "":
            filters['employment_type'] = request.GET['emp_employ_type']
        if request.GET['emp_leave'] != "":
            filters['leave'] = request.GET['emp_leave']
        employees = SPARQLModel.get_advance_search(filters=filters)
        response = {'roles': roles, 'employees': employees}
        return JsonResponse(response)

