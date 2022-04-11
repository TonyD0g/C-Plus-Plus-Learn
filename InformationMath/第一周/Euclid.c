 #include "stdio.h"
 /*用 Euclid 算法求两个正整数的最大公因子*/
 //这个以前好像写过，不过我用的复杂算法
int main()
 {
     int m, n, r;
     printf("Please input:\n");
     scanf("%d %d", &m, &n);
     while(n != 0)
     {
         r = m % n;
         m = n;
         n = r;
     }
     printf("outcome is %d\n", m);
     return 0;
 }

