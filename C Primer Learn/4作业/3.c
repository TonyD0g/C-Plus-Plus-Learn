#include<stdio.h>
	int main()
	{
	    int x,i,score[10],ave=0,sum=0;
	    int y=0;
	    float s=0;
	    printf("Input numbers: ");
	    for(x=1;x<=10;x++)
	    {
	        
	            scanf("%d",&i);
	            score[x-1]=i;
	        
	    }
	    for(x=10;x>=1;x--)
	    {    
	        
 	        y=score[x-1];
	        if(y%2==0)
	        {
	            ave=ave+1;
	
	
	            s=s+y;
	        }
	    }
	    s=s/ave;
	    printf("the number of even number is: %d\n",ave);
	    printf("the average of even number is: %.1f\n",s);
	    return 0;
	
	}

