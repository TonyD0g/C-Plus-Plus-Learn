#include<stdio.h>
int main()
{
	int i,s,k;
	i = 1;s = 0;k=0;
	while(i<100)
	{
		s = s + i ;
		if(i%2!=0)
		{
			k=k+1;
			i=i+2;
		}
		else
		i  = i +2;
		
			
				
	}
		printf("s=%d\n",s);
		printf("k=%d\n",k);
		return s;


}
