- map/multimap里放着的都是**pair**模版类的对象，且按first从小到大排序

  

# multimap类模板

```c++
template<class Key, class T, class Pred = less<Key>, class A = allocator<T> > 
class multimap { 
    ….
    typedef pair<const Key, T> value_type; 
    …….
}; //Key 代表关键字的类型
```

* multimap中的元素由 <关键字,值>组成，每个元素是一个pair对象，关键字就是first成员变量，其类型是Key

* multimap 中允许多个元素的关键字相同。元素按照first成员变量从小到大排列，缺省情况下用 less<Key> 定义关键字的“小于”关系

* 例子:  一个学生成绩录入和查询系统

  ```
  接受以下两种输入:
  Add name id score
  Query score
  
  name是个字符串，中间没有空格，代表学生姓名。id是个整数，代表学号。score是个整数，表示分数。学号不会重复，分数和姓名都可能重复。两种输入交替出现。第一种输入表示要添加一个学生的信息，碰到这种输入，就记下学生的姓名、id和分数。第二种输入表示要查询，碰到这种输入，就输出已有记录中分数比score低的最高分获得者的姓名、学号和分数。如果有多个学生都满足条件，就输出学号最大的那个学生的信息。如果找不到满足条件的学生，则输出“Nobody”
  
  输入样例：
  Add Jack 12 78
  Query 78
  Query 81
  Add Percy 9 81
  Add Marry 8 81
  Query 82
  Add Tom 11 79
  Query 80
  Query 81
  
  输出果样例：
  Nobody
  Jack 12 78
  Percy 9 81
  Tom 11 79
  Tom 11 79
  ```

```c++
#include <iostream>
#include<map>
#include <string>
using namespace std;

class Student {
public:
    struct Info {
        string name;
        int id;
    };

    int score;
    Info info;
};

typedef multimap<int, Student::Info> MAP_STD;

void Print(MAP_STD & mp) {
    MAP_STD::iterator pp = mp.begin();
    for (; pp!=mp.end(); ++pp) {
        cout << pp->second.name << " " << pp->second.id << " " << pp->first << endl;
    }
}

int main() {
    string cmd;
    Student st;
    MAP_STD mp;

    while (cin >> cmd) {
        if (cmd == "Add") {
            cin >> st.info.name >> st.info.id >> st.score;
            mp.insert(make_pair(st.score, st.info));
            Print(mp);
        } else if (cmd == "Query") {
            int score;
            cin >> score;

            MAP_STD::iterator pp = mp.lower_bound(score);

            if (pp != mp.begin()) {  // 注意, 不是判断pp == mp.end(), 在[begin(), it)中, 也就是如果it = begin(), 表明没有找到
                cout << "Found" << endl;

                --pp; // 注意lower_bound是右开区间
                score = pp->first; // 比要查询分数低的最高分

                // 查找最大的ID号
                int maxID = pp->second.id;
                MAP_STD::iterator maxPP = pp;

                for ( ; pp->first==score; --pp) {
                    cout << pp->second.name << " " << pp->second.id << " " << pp->first << endl;

                    if (maxID < pp->second.id) {
                        maxID = pp->second.id;
                        maxPP = pp;
                    }

                    if ( pp == mp.begin() ) { // 第1个元素也是要查找的内容, 以后就不用再查了
                        break;
                    }
                }

                cout << "The maxID: " << maxPP->second.name << " " << maxPP->second.id << " " << maxPP->first << endl;
            } else {
                cout << "Not Found" << endl;
            }
        } else {
            cout << "Wrong command" << endl;
        }
    }

    return 0;
}
```



# map模板类定义

```c++
template<class Key, class T, class Pred = less<Key>, class A = allocator<T> > 
class map { 
    ….
    typedef pair<const Key, T> value_type; 
    …….
};
```

* 基本和multimap一样，只不过关键字(first成员变量)各不相同， 因此插入元素可能失败
* map还比mutimap多了个[ ]成员函数， 若pairs为map模版类的对象pairs[key]， 则：
  * 返回对关键字等于key的元素的值(second成员变量）的引用
  * 若没有关键字为key的元素，则会往pairs里插入一个关键字为key的元素，其值用无参
    构造函数初始化，并返回其值的引用.
  * 若 map<int,double> pairs，则：
    * pairs[50] = 5; // 会修改pairs中关键字为50的元素，使其值变成5
    * 若不存在关键字等于50的元素，则插入此元素，并使其值变为5

```c++
#include <iostream>
#include<map>
#include <string>
using namespace std;

template <class T1, class T2>
ostream & operator<<(ostream &o, const pair<T1, T2> &p) {
    o << "("<< p.first << ", " << p.second << ")" << " " ;
    return o;
}

template <class T>
void Print(const T &begin, const T &last) {
    for (T pp = begin; pp!=last; ++pp) {
        cout << *pp;
    }
    cout << endl;
}

int main() {
    map<int, double> mmap;

    mmap.insert(make_pair(4, 8.9));
    Print(mmap.begin(), mmap.end());

    mmap.insert(make_pair(2, 2.66));
    Print(mmap.begin(), mmap.end()); // 输出： (2, 2.66) (4, 8.9), 默认按关键字从小到大输出

    mmap[4] = 30; // 有关键字“4”,则修改原来的值
    Print(mmap.begin(), mmap.end());

    mmap[7] = 50.98; // 没有关键字“7”,则插入新值
    Print(mmap.begin(), mmap.end()); // 输出: (2, 2.66) (4, 30) (7, 50.98)
    
    return 0;
}
```

# map例题：单词词频统计

```
输入大量单词，每个单词，一行，不超过20字符，没有空格。 按出现次数从多到少输出这些单词及其出现次数。出现次数相同的，字典序靠前的在前面
输入样例：
this
is
ok
this
plus
that
is
plus
plus
输出样例：
plus 3
is 2
this 2
ok 1
that 1
```

```c++
#include <iostream>
#include <string>
#include <map>
#include <set>
using namespace std;

struct Word {
    string wd;
    int times{};
};

struct Rule {
    bool operator()(const Word& w1, const Word& w2) const {
        if (w1.times != w2.times) {
            return (w1.times > w2.times);
        } else {
            return (w1.wd < w2.wd);
        }
    }
};

int main() {
    string s;
    map<string, int> mp;
    set<Word, Rule> st;

    // 插入单词和统计单词的个数
    while (cin >> s) {
        ++mp[s]; // mp[s]返回的是second部分的引用
    }

    // 将mp数据放入set中
    for (const auto& it:mp) {
        cout << "(" << it.first << ", " << it.second << ") " << endl;

        Word tmp;
        tmp.wd = it.first;
        tmp.times = it.second;

        st.insert(tmp);
    }

    // 已在set中按照"Rule"完成规则比较, 直接打印输出结果
    for (const auto& it : st) {
        cout << it.wd << " " << it.times << endl;
    }

    return 0;
}
```



