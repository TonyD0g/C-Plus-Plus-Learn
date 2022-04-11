#include <stdio.h>

void factor1ization(long num);//因式分解 
int isPrime (long num);//判断素数

int main() 
{ 
    long num; 
    do 
    { 
        printf("Intput the number: "); 
        scanf("%ld",&num); 
    }while(num<=1); 

    if ( isPrime(num) ) 
    { 
        printf("Outcome:	   %ld=1*%ld\n",num,num); 
    } 
    else 
    { 
        factor1ization(num); 
    }
    return 0; 
} 


int isPrime(long num) 
{ 
    long i; 
    int isPrime = 1; 
    for(i=2;i<=num/2;i++) 
    { 
        if(num % i == 0) 
        { 
            isPrime = 0; 
            break; 
        } 
    } 
    return isPrime; 
} 

void factor1ization(long num) 
{     
    long factor1; 
    printf("Outcome:	   %ld=",num);
    do{ 
    for(factor1=2; factor1 < num; factor1++ ) 
        {    
            if(isPrime(factor1)&&( num%factor1 == 0))
            { 
                printf("%ld*",factor1);
                num = num / factor1;
                break; 
            } 
        } 
            if(isPrime(num))
            { 
                printf("%ld\n",num); 
                break; 
            } 
        }
        while(1); 
}
