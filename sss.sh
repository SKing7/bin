#!/bin/sh
cd /Users/liuzhe/.ShadowsocksX
if [ -z $1 ]
    then 
        echo '-a: all proxy'
        echo '-l: limit proxy by pac'
elif [ $1 = "-a" ]
    then 
        sed -i -e 's/allProxy=false;/allProxy=true;/g' gfwlist.js
        echo 'All Proxy Done';
elif [ $1 = "-l" ]
    then 
        sed -i -e 's/allProxy=true;/allProxy=false;/g' gfwlist.js
        echo 'Limit Proxy Done';
elif [ $1 = "-p" ]
    then 
        sed -i -e 's/\/\/OUTGFW/\/\/OUTGFW\\\\r\\\\n  '$2'/g' gfwlist.js
elif [ $1 = "-g" ]
    then 
        sed -i -e 's/\/\/INGFW/\/\/INGFW\\r  ${2}/g' gfwlist.js
elif [ $1 = "-d" ]
    then 
        `vim gfwlist.js`
else
    then
        echo '-a: all proxy'
        echo '-l: limit proxy by pac'
fi
