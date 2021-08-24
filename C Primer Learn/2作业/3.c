#include<stdio.h>
#include<math.h>
int main()
{
	double x,y;
	scanf("%lf",&x);
	if((x<-10)||(x>4&&x<5)||(x>7&&x<8)||(x>12))
	{	printf("No answer.\n");}
	else	
		if(x>=-10&&x<=4)
	{	y = fabs(x-2);
	printf("y=%.2lf\n",y);
		
	}
	else 
	
	if(x>=5&&x<=7)
	{	y= x+10;
		printf("y=%.2lf\n",y);
	}
	else 
	{	y= x*x*x*x;
		printf("y=%.2lf\n",y);
	}
	

	return 0;


	

	
	
	




}
