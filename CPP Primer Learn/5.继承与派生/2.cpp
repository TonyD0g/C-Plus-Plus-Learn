/*
    设计一个基类，从基类派生圆，从圆派生圆柱，设计成员函数输出
    他们的面积和体积。
*/

#include<iostream>
using namespace std;
class Basic
{
    protected:
        double r;
    public:
        Basic() 
        {
             r = 0; 
        }
        Basic(double a):r(a)
        {

        }
};
class Circular:public Basic
{
    protected:
        double area;
    public:
        Circular(double a)
        {
            r = a;
            area = 3.14 * r * r;            
        }
        double getArea()
        {
            return area;
        }
};
/* Circular::Circular(double a)
{
        r = a;
        area = 3.14 * r * r;
}*/

class Column:public Circular
{
    protected:
        double h;
        double cubage;
    public:
        Column(double a,double b):Circular(a)
        {
            h = b;
            cubage = getArea() * h;

        }
        double getCubage()
        {
            return cubage;
        }
};
int main()
{
    Circular circular(45);
    Column Column(12, 10);
    cout << "The circular area is:  " << circular.getArea() << endl;
    cout << "The column cubage is:   " << Column.getCubage() << endl;
    return 0;
}