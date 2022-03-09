from urllib import request
from django.shortcuts import render
from django.http import HttpResponse, request
from .models import user,artist,rating

# Create your views here.
def index(request):
    user_rating = rating.objects.all()
    input_user = request.POST.get('Username')
    queried = rating.objects.all().filter(username = input_user)
    return render(request,"music/index.html",
        {'user_rating':user_rating,
        'input_user':input_user,
        'queried':queried})

def registration(response):
    return HttpResponse("<h1>Registration</h1>")