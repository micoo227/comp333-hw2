from django.shortcuts import render
from django.http import HttpResponse, HttpResponseRedirect
from django.urls import reverse
from .models import User,Artist,Rating

# Create your views here.
def index(request):
    user_rating = Rating.objects.all()
    input_user = request.POST.get('Username')
    queried = Rating.objects.all().filter(username = input_user)
    return render(request,"music/index.html",
        {'user_rating':user_rating,
        'input_user':input_user,
        'queried':queried})

def registration(request):
    register_button = request.POST.get('register')
    entered_username = request.POST.get('username')
    entered_password = request.POST.get('password')

    if not entered_username or not entered_password:
        context = {
            'error_message': "Please fully complete the form.",
            'register_button': register_button,
        }
        return render(request, "music/registration.html", context)

    if User.objects.get(username=entered_username):
        context = {
        'error_message': "The username you provided is already taken. Please try again.",
        'register_button': register_button,
        }
        return render(request, "music/registration.html", context)

    user = User()
    user.username = entered_username
    user.password = entered_password
    user.save()

    return HttpResponseRedirect(reverse('music:index'))