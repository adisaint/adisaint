git remote add gitee https://gitee.com/adisaint/adisaint.git
git remote add github https://github.com/adisaint/adisaint.git
git config --global user.email "adisaint@163.com"
git config --global user.name "adisaint"
git add .
git commit -m "Commit time: %date% %time%"
git push gitee master
git push github master
pause
