screen -ls | grep '\.liuzhe02' | awk -F. '{print $1}' | xargs kill
