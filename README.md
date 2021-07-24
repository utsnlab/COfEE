# COfEE Events Annotator Tool

[TOC]

# What is COfEE?

**COfEE** (which stands for "a **Comprehensive Ontology for Event Extraction**"), is an event ontology with a more general event schema compared to its predecessors (such as ACE), which is simpler, more flexible and suitable for practical applications. COfEE introduces **12** event **types** and **119** event **subtypes** in two hierarchy levels with **21** argument roles. The event subtypes are defined such that they are conceptually different from each other (with the least possible overlap) in order to tackle the complexity in choosing the type of events. COfEE covers a wide range of topics, from “Politics” to “Life”, “Business” and “Natural Disasters”. It also defines new event types such as “Cyberspace”, “Science” and “Environment”, and new subtypes such as “Cyberattack”, “Extinction” and “Epidemics” by incorporating a data-driven approach by human experts. Additionally, COfEE presents new roles such as “scale”, “number of missing entities”, “number of participants” etc. to capture different dimensions of events more effectively.

This repository contains the source code for COfEE's annotation tool which can be self-hosted (read the descriptions below). An online demo version is also available at [cofee.sociallab.ir](cofee.sociallab.ir).

The current repository includes the Wikipedia corpus used for evaluation and experiments of the original manuscript.

## Installation (instructions for self-hosting)

**Requirements**
Make sure you have `docker`  and `docker-compose` installed: 

- https://docs.docker.com/engine/install/ubuntu/
- https://docs.docker.com/compose/install/

**Installation**

- Clone the project and change working directory into the cloned folder
- You can change hostname in `Dockerfile` and `annotate.conf` to your desired name.

- You can change database config (username, password) in `docker-compose.yml` and `/include/config.php`

- Then run `docker-compose build`
- Then run `docker-compose up -d`

By default the project will start on port `80`, it can be changed by modifying the config files.

**NOTE**: This tool can be deployed without using docker. It is quite straightforward if you have the experience of deploying PHP applications.

**NOTE**: Default admin credentials are:

	- Username: ***admin***
	- Password: ***123***

 ## Paper Experiments Data

The corpus of Wikipedia events that the original paper's experiments were conducted on can be downloaded from:

- resources/Wiki-EventSentences.tar.gz

Google News 300M Word2Vec word embedding:

- https://github.com/RaRe-Technologies/gensim-data (word2vec-google-news-300)

## User Guide

The entire process of annotation in COfEE tool is summarized in the picture below:

![image-20210720165804855](C:\Users\dozha\AppData\Roaming\Typora\typora-user-images\image-20210720165804855.png)

The steps in annotation phase are:

1. An `admin` user is initialized, and then the admin user creates sub-users responsible for annotation of data. 
2. The `admin` user creates projects. Sub-users can be assigned to multiple different projects and each project could include textual data from different domains (topics). 
3. Entity types, event types, event subtypes and argument roles are defined based on COfEE, although these can be further customized by `admin`. In fact, you can define new entity types, event type, event subtypes and argument roles in the COfEE annotation tool as per your needs. 
4. The `admin` user can import text data using web forms, Excel or CSV files into COfEE. You can also import entities that are extracted automatically by NER tools (In order to make the annotation phase easier, we suggest using news headlines instead of the news body since headlines are shorter and rich enough to represent the main body).
5. By taking these steps, annotation phase is ready to be started. Take this use-case scenario for example: a user selects an arbitrary entity, then he/she should select an event trigger that appears on the text and assign the most relevant event subtype to it. Next, an entity is selected and a role is assigned to it according to the corresponding event subtype. 
6. The `admin` user can export the data annotated by sub-users in Excel or CSV format.

As you have probably figured, step 5 is the main phase of data annotation by human coders. A part of the tool's capabilities are represented in the following pictures:

- Event trigger annotation when “outbreak” is selected as an event of the subtype “Epidemics”:

  ![image-20210720170422308](C:\Users\dozha\AppData\Roaming\Typora\typora-user-images\image-20210720170422308.png)

- Argument roles annotation phase: selecting the arguments of an “outbreak” event. The roles of the entities are selected through a drop-down list:

  ![image-20210720170454501](C:\Users\dozha\AppData\Roaming\Typora\typora-user-images\image-20210720170454501.png)

- An entity “115” is selected and its roles in different events are shown:

  ![image-20210720170515305](C:\Users\dozha\AppData\Roaming\Typora\typora-user-images\image-20210720170515305.png)



# Citation

Please cite COfEE on your works as follows:

[Bibtex]

```Bibtex
@misc{balali2021cofee,
      title={COfEE: A Comprehensive Ontology for Event Extraction from text, with an online annotation tool}, 
      author={Ali Balali and Masoud Asadpour and Seyed Hossein Jafari},
      year={2021},
      eprint={2107.10326},
      archivePrefix={arXiv},
      primaryClass={cs.CL}
}
```

