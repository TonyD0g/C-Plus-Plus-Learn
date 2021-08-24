描述

写一个程序完成以下命令：
new id ——新建一个指定编号为id的序列(id<10000)
add id num——向编号为id的序列加入整数num
merge id1 id2——合并序列id1和id2中的数，并将id2清空
unique id——去掉序列id中重复的元素
out id ——从小到大输出编号为id的序列中的元素，以空格隔开

输入

第一行一个数n，表示有多少个命令( n＜＝２０００００)。以后n行每行一个命令。

输出

按题目要求输出。

样例输入

```
16
new 1
new 2
add 1 1
add 1 2
add 1 3
add 2 1
add 2 2
add 2 3
add 2 4
out 1
out 2
merge 1 2
out 1
out 2
unique 1
out 1
```

样例输出

```
1 2 3 
1 2 3 4
1 1 2 2 3 3 4

1 2 3 4
```



```c++
// NOTE: 使用数组+链表实现

#include <iostream>
#include <list>
#include <string>
#include <vector>
using namespace std;

class MyList {
private:
    vector<list<int>> lst;
public:
    void new_(int id) {
        lst.emplace_back();
    }

    void add_(int id, int data) {
        lst[id-1].push_back(data);
    }

    void merge_(int id1, int id2) {
        lst[id1-1].sort();  // list合并前要先排序
        lst[id2-1].sort();
        lst[id1-1].merge(lst[id2-1]);
    }

    void unique_(int id) {
        lst[id-1].sort();  // 要删除重复元素,要先排序
        lst[id-1].unique();
    }

    void out_(int id) {
        for(auto num : lst[id-1]) {
            cout << num << " ";
        } cout << endl;
    }
};

int main()
{
    int n;
    cin >> n;

    string cmd;
    int id1, id2;

    MyList myList;

    while (n--) {
        cin >> cmd;
        if (cmd == "new") {
            cin >> id1;
            myList.new_(id1);
        } else if (cmd  == "add") {
            int data;
            cin >> id1 >> data;
            myList.add_(id1, data);

        } else if (cmd  == "out") {
            cin >> id1;
            myList.out_(id1);

        } else if (cmd  == "merge") {
            cin >> id1 >> id2;
            myList.merge_(id1, id2);
        } else if (cmd  == "unique") {
            cin >> id1;
            myList.unique_(id1);
        }
    }

    return 0;
}
```

```c++
//NOTE: 使用map+链表实现
#include <iostream>
#include <list>
#include <string>
#include <map>
using namespace std;

class MyList {
private:
    map<int, list<int>> ml;
public:
    void new_(int id) {
       ml[id] = list<int>();
    }

    void add_(int id, int data) {
        ml[id].push_back(data);
    }

    void merge_(int id1, int id2) {
        ml[id1].sort();
        ml[id2].sort();　// 合并前要先排序
        ml[id1].merge(ml[id2]);
    }

    void unique_(int id) {
        ml[id].sort();  // 要删除重复元素,要先排序
        ml[id].unique();
    }

    void out_(int id) {
        ml[id].sort();
        for(auto num : ml[id]) {
            cout << num << " ";
        } cout << endl;
    }
};

int main()
{
    int n;
    cin >> n;

    string cmd;
    int id1, id2;

    MyList myList;

    while (n--) {
        cin >> cmd;
        if (cmd == "new") {
            cin >> id1;
            myList.new_(id1);
        } else if (cmd  == "add") {
            int data;
            cin >> id1 >> data;
            myList.add_(id1, data);

        } else if (cmd  == "out") {
            cin >> id1;
            myList.out_(id1);

        } else if (cmd  == "merge") {
            cin >> id1 >> id2;
            myList.merge_(id1, id2);
        } else if (cmd  == "unique") {
            cin >> id1;
            myList.unique_(id1);
        }
    }

    return 0;
}
```

