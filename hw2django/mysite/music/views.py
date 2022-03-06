from django.shortcuts import render
from django.http import HttpResponse

# Create your views here.
def index(response):
    return HttpResponse("<h1>Testing Site</h1>")

def registration(response):
    return HttpResponse("<h1>Registration</h1>")