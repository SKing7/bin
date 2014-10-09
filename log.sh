awk -F '\\|\\|' 'BEGIN{
    while ("cat test.log" | getline) {
        if (length($0) == 0) { continue; } 
        split($3, a, " ");
        //s.gif?(.+)
        ss = substr($9, index($9,"?") + 1);
        split(ss, b, " ");
        split(b[1], c, "&");
        //c: [0]xx=11  [1]yy=2
        print(a[1]"------------"c[1]);
    };
}'
