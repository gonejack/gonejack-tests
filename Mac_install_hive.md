Mac 安装 Hive 爬坑教程（2017-11-10）

1. Install MySQL

   ```shell
   brew install mysql
   ```

   Info:

   - config file

     ```shell
     vi /usr/local/etc/mys.cnf
     ```

   - for enable anonymous login:

     ```
     # for anonymous login
     skip-grant-tables
     ```

   Run up:

   ```shell
   mysql.server start
   ```

   Create hive metastore database:

   ```sql
   create database metastore;

   alter database metastore character set latin1;
   ```

2. Install Hive

   ```shell
   brew install hive

   # (坑)
   # Q: brew link hadoop failed
   # A:
   mkdir /usr/local/sbin
   chmod o+w /usr/local/sbin
   brew link hadoop
   ```

   Info:

   - show install Location:

     ```shell
     echo `brew --prefix hive`
     ```

   - new config file:

     ```shell
     cd $(brew --prefix hive)
     cp libexec/conf/hive-default.xml.template libexec/conf/hive-site.xml
     ```

   - find and modify:

     - connection

       ```xml
       <property>
           <name>javax.jdo.option.ConnectionURL</name>
           <value>jdbc:mysql://localhost/metastore?useSSL=false</value>
       </property>
       <property>
           <name>javax.jdo.option.ConnectionDriverName</name>
           <value>com.mysql.jdbc.Driver</value>
       </property>
       <property>
           <name>javax.jdo.option.ConnectionUserName</name>
           <value>hive</value>
       </property>
       <property>
           <name>javax.jdo.option.ConnectionPassword</name>
           <value>hive</value>
       </property>
       ```

     - dirs

       ```xml
       <property>
         <name>hive.repl.rootdir</name>
         <value>/Users/youi/WorkSpaces/hive/repl/</value>
       </property>
       <property>
         <name>hive.repl.cmrootdir</name>
         <value>/Users/youi/WorkSpaces/hive/cmroot/</value>
       </property>
       <property>
         <name>system:java.io.tmpdir</name>
         <value>/tmp/hive/java</value>
       </property>
       <property>
         <name>system:user.name</name>
         <value>${user.name}</value>
       </property>
       ```

     - hive create schemas by itself:

       ```xml
       <property>
         <name>datanucleus.schema.autoCreateAll</name>
         <value>true</value>
       </property>
       <property>
         <name>hive.metastore.schema.verification</name>
         <value>false</value>
       </property>
       ```


   Add MySQL Connector:

   ```shell
   # download the jar by yourself.
   mv mysql-connector-java-5.1.42/mysql-connector-java-5.1.42-bin.jar $(brew --prefix hive)/libexec/lib/
   ```

   Export ENV Variables:

   ```shell
   vi ~/.bash_profile
   ```

   ```shell
   export HIVE_HOME="/usr/local/opt/hive"
   export HCAT_HOME="$HIVE_HOME/libexec/hcatalog"
   ```

   Run up:

   ```xml
   hive
   ```

