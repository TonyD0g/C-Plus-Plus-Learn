/*
    基类是使用极坐标的点类，从它派生一个圆类，圆类使用点类
    的坐标作为圆心，圆周通过极坐标原点，圆类有输出圆心
    直角坐标，圆半径和面积的成员函数。完成类的设计并验证。
*/
#include<iostream>
#include<cmath>
using namespace std;
class Point//点类
{
    protected:
        double x, y;
    public:
        Point(){}
};
class Circular:public Point
{
    protected:
        double r, area;
    public:
        Circular(int a,int b)
        {
            x = a;
            y = b;
            r = sqrt(x * x + y * y);
            area = 3.14 * r * r;
        }
        void printPoint()
        {
            cout << "The Circular rectangular coordinates is:  ( " <<x<<","<<y<<")"<< endl;
            //圆形直角坐标
        }
        void printRadius()
        {
            cout << "The Circular radius is:  " << r << endl;
        }
        void printArea()
        {
            cout << "The Circular area is:    " << area << endl;
        }
};
int main()
{
    Circular c(10, 25);
    c.printPoint();
    c.printRadius();
    c.printArea();
    return 0;
}