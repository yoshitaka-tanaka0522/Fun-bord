#-----------FROM-----------
#FROM命令はイメージビルドのためのベースイメージを設定できる。
#FROM イメージ名:タグ名で指定する。
FROM php:8.0-fpm-buster

#-----------SHELL-----------
#SHELL命令は何も指定しない場合はSHELL ["/bin/sh", "-c"] がデフォルト値となる(Linuxの場合)
#パイプ中のあらゆる段階でエラーがあれば失敗とするため、pipefailオプションを明示的に指定する。
#-oオプションはオプションを設定するためのオプション
#-eオプションはそのシェルスクリプト内で何らかのエラーが発生した時点で、それ以降の処理を中断できる。
#-uオプションは未定義の変数に対して読み込み等を行おうとした際にエラーとなる。
#-xオプションは実行したコマンドを全て標準エラー出力する。
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

#-----------ENV-----------
#ENV命令はコンテナ内のサーバー環境変数を設定
#https://matsuand.github.io/docs.docker.jp.onthefly/engine/reference/builder/#env
ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

#-----------COPY-----------
#COPY <src>... <dest>
#srcからファイルやディレクトリを新たにコピーして、コンテナー内のファイルシステムのパスdestに追加する。
#https://matsuand.github.io/docs.docker.jp.onthefly/engine/reference/builder/#copy
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

#-----------apt-get----------- 
#➀updateインストール可能なパッケージの「一覧」を更新する。
#➁apt-get -y install xxx でLaravelのインストールに必要な下記のパッケージをインストールする。
#https://packages.debian.org/ja/sid/git
#https://packages.debian.org/ja/sid/unzip
#https://packages.debian.org/ja/sid/libzip-dev
#https://packages.debian.org/ja/sid/libicu-dev
#https://packages.debian.org/ja/sid/libonig-dev
#③パッケージインストールで使用したキャッシュファイルを削除する。
RUN apt-get update && \
  apt-get -y install git unzip libzip-dev libicu-dev libonig-dev && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-install intl pdo_mysql zip bcmath

#-----------COPY----------- 
#https://matsuand.github.io/docs.docker.jp.onthefly/engine/reference/builder/#copy
#自分のPC(ホスト)のフォルダファイルのphp.iniファイルをdockerファイルの「/usr/local/etc/php/php.ini」をコピーする
COPY ./php.ini /usr/local/etc/php/php.ini

#-----------WORKDIR-----------
#workフォルダを作成する。 
WORKDIR /work