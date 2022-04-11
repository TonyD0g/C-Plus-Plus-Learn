#include <stdio.h>
//有注释的版本

int isPrime (long num);//判断一个数是不是素数； 
void Fact (long num);//因式分解； 

int main() 
{ 
    long num; 

    do 
    { 
        printf("Please intput the number: "); 
        scanf("%ld",&num); 
    }while(num<=1); 

    if ( isPrime(num) ) 
    { 
        printf("%ld=%ld\n",num,num); 
    } 
    else 
    { 
        Fact(num); 
//        printf("\n");//删除最后一个x,然后输出换行符。 
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

void Fact(long num) 
{     
    long factor; 
    printf("%ld=",num);//先输出数值部分 
    do{ 
    for (factor=2; factor < num; factor++ ) 
        {    
//          printf("Test sentence 1.\t num = %ld, factor=%ld\n",num,factor); 
            if(isPrime(factor)&&( num%factor == 0))//判断是否是因数； 
                //如果是因数，将其输出，然后将原来的数字缩小。再次进行判断。 
            { 
                printf("%ldx",factor);//输出因式分解部分； 
                num = num / factor;//得到新的带分解因数； 
                break; 
            } 
        } 
            if (isPrime(num))//如果num是素数，直接推出； 
            { 
                printf("%ld\n",num); 
                break; 
            } 
//          printf("Test sentence.\tnum = %ld\n",num); 
        }while(1); 
        return ; 
}
