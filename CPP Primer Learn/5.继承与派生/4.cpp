/*
    建立一个基类Building ,用来存储一座楼房的层数，房间数
    以及它的总平方英尺数。建立派生类Housing,继承Building,
    并存储下面的内容：卧室和浴室的数量，另外，建立
    派生类Office,继承Building,并存储灭火器和电话的数目。
    然后，编制应用程序，建立住宅楼对象和办公楼对象，并
    输出它们的有关数据.
*/
#include<iostream>
using namespace std;
class Building
{
    public:
        Building(int f,int r,double ft)
        {
            floors = f;
            rooms = r;
            footage = ft;
        }
        void show()
        {
            cout << "floors:  " << floors << endl;
            cout << "rooms:   " << rooms << endl;
            cout << "total area:  " << footage << endl;
        }
    protected: 
            int floors;
            int rooms;
            double footage;
};
class Housing:public Building
{
    public:
        Housing(int f,int r,double ft,int bd,int bth):Building(f,r,ft)
        {
            bedrooms = bd;
            bathrooms = bth;
        }
        void show()
        {
            cout << "\n Housing:\n";
            Building::show();
            cout << "bedrooms:    " << bedrooms << endl;
            cout << "bathrooms:   " << bathrooms << endl;
        }
    private:
        int bedrooms;
        int bathrooms;
};
class Office:public Building
{
    public:
        Office(int f,int r,double ft,int ph,int ex):Building(f,r,ft)
        {
            phones = ph;
            extinguishers = ex;//灭火器
        }
        void show()
        {
            cout << "\n Housing:\n";
            Building::show();
            cout << "phones:  " << phones << endl;
            cout << "extinguishers:   " << extinguishers << endl;
        }
    private:
        int phones;
        int extinguishers;
};
int main()
{
    Housing hob(5, 7, 140, 2, 2);
    Office oob(8, 12, 500, 12, 2);
    hob.show();
    oob.show();
    return 0;
}